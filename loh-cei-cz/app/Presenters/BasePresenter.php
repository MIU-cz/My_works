<?php

declare(strict_types=1);

namespace App\Presenters;

use Configuration;
use Nette;
use Nette\Application\UI;
use Nette\Application\UI\Form;
use Nette\Application\UI\ITemplate;
use Nette\Mail\Message;
use Nette\Mail\SendException;
use Nette\Mail\SendmailMailer;
use Tracy\Debugger;

class BasePresenter extends Nette\Application\UI\Presenter {

    protected $db;
    private $contentImages;
    public $companyId = 1;
    public $languages = ['cs', 'en'];
    public $micrositeId = 16;
    public $mainWebsiteUrl;
    protected $parameters;
    protected $texts;

    /** @persistent */
    public $language = 'cs';

    public function __construct(Nette\Database\Context $db, Configuration $configuration) {
        parent::__construct();
        $this->parameters = $configuration->parameters;
        $this->db = $db;
    }

    public function startup() {
        parent::startup();
        if (!isset($this->language)) {
            $this->language = 'cs';
        }
        $this->texts = $this->db->table('text')
                ->where('microsite_id', 1)
                ->fetchPairs('code', $this->language);
        $textsForThisMicrosite = $this->db->table('text')
                ->where('microsite_id', $this->micrositeId)
                ->fetchPairs('code', $this->language);
        foreach ($textsForThisMicrosite as $key => $value) {
            $this->texts[$key] = $value;
        }
        $this->template->cleaningPlants = $this->db->table('branch')
                ->select('*, name_' . $this->language . ' name, url_' . $this->language . ' url')
                ->where('microsite_id', $this->micrositeId)
                ->where('name_' . $this->language . ' > ""')
                ->where('text_' . $this->language . ' > ""')
                ->order('order');
    }

    public function beforeRender() {
        parent::beforeRender();
        $this->template->micrositeId = $this->micrositeId;
        $this->template->mainWebsiteUrl = $this->mainWebsiteUrl = $this->db->table('company')->get(1)->company_website_url;
        $this->template->languages = $this->languages;
        $this->template->language = $this->language;
        $requestUri = explode('?', $_SERVER['REQUEST_URI'], 2);
        $this->template->canonicalLink = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $requestUri[0];
        $this->template->companyInfo = $this->db->table('company')
                ->select('name, legal_name, id_number, vat_id, street, city, city_district, postal_code, country, email, phone')
                ->where('id', $this->companyId)
                ->fetch();
        $this->contentImages = $this->db->table('content_images')
                ->where('microsite_id', $this->micrositeId)
                ->fetchPairs('code');

        // Remove start slash
        $url = $_SERVER['REQUEST_URI'] == '/' ? '/' : substr($_SERVER['REQUEST_URI'], 1);
        $meta = $this->db->table('page_meta')
                ->where('url', $url)
                ->where('microsite_id', $this->micrositeId)
                ->fetch();
        if ($meta) {
            $this->template->meta = $meta;
        }

        $this->template->headerText = $this->db->table('text')
                ->where('code LIKE ?', strtoupper($this->action) . '_HEADER_TEXT')
                ->fetch();
        $this->template->microsite = $this->db->table('microsite')
                ->where('id', $this->micrositeId)
                ->fetch();
        $this->template->lightGalleryPlugin = in_array($this->action, ['space', 'spaceArea']);
        $this->template->developmentMode = Debugger::$productionMode == Debugger::DEVELOPMENT;
        /*file f "
                . "LEFT JOIN file_category fc ON fc.id = category_id "
                . "WHERE f.microsite_id = ? "
                . "AND !IFNULL(fc.with_qr, 0) "
                . "AND (language IS NULL or language = ?) "*/
        $this->template->filesExists = $this->db->table('file')
                ->where('microsite_id', $this->micrositeId)
                ->where('language IS NULL OR language = ?', $this->language)
                ->count() > 0;
    }

    public function afterRender() {
        parent::afterRender();
        $selection = $this->db->table('page_meta')
                ->where('microsite_id', $this->micrositeId);
        if ($id = $this->getParameter('id')) {
            $meta = $selection->where('url', $this->action . '/' . $id)->fetch();
            if ($meta && $meta->title) {
                $this->template->meta->title = $meta->title;
            }
            if ($meta && $meta->description) {
                $this->template->meta->description = $meta->description;
            }
        }
        else {
            $this->template->meta = $selection->where('url', substr(strtok($_SERVER['REQUEST_URI'], '?'), 1))->fetch();
        }
        if (isset($this->template->meta)) {
            if ($this->template->meta->title) {
                $this->template->title = $this->template->meta->title;
            }
            if (isset($this->template->meta->description)) {
                $this->template->description = $this->template->meta->description;
            }
        }
    }

    protected function createTemplate($class = null): ITemplate {
        $template = parent::createTemplate($class);

        $template->addFilter('text', function ($text) {
            // Search for text for microsite
            $row = $this->db->table('text')
                    ->where('microsite_id', $this->micrositeId)
                    ->where('code LIKE ?', $text)
                    ->fetch();

            // If not for actual microsite, search for text for all microsites
            $row = $row ?? $this->db->table('text')
                    ->where('microsite_id', 1)
                    ->where('code LIKE ?', $text)
                    ->fetch();

            if ($row) {
                return $this->nbsp($row[$this->language]);
            }
            return '';
        });

        $template->addFilter('nbsp', function ($text) {
            return $this->nbsp($text);
        });

        $template->addFilter('autoVersion', function ($file) {
            $path = __DIR__ . '/../../www/' . $file;
            if (!file_exists($path)) {
                return $file;
            }
            $mtime = filemtime($path);
            return $this->template->basePath . '/' . $file . '?ts=' . $mtime;
        });

        $template->addFilter('ucfirst', function ($text) {
            return $this->mbUcFirst($text);
        });

        $template->addFilter('protectEmail', function ($text) {
            return str_replace('@', '&#64;', $text);
        });

        $template->addFilter('truncateWords', function ($text, $length) {
            return $this->truncateWords($text, $length);
        });

        $template->addFilter('imagePath', function ($imageCode) {
            if (!isset($this->contentImages[$imageCode])) {
                return null;
            }
            $image = $this->contentImages[$imageCode];
            return $this->mainWebsiteUrl . '/images/content-images/' . $this->micrositeId . '/' . $image->id . '.' . $image->extension . '?v=' . $image->version;
        });

        $template->addFilter('nl2br', 'nl2br');

        $template->addFilter('number', function ($number) {
            return $number ? number_format($number, 0, ',', ' ') : $number;
        });

        $template->addFilter('config', function ($key) {
            return $this->config($key);
        });

        $template->addFilter('postalCode', function ($row) {
            return substr($row->postal_code, 0, 3) . ' ' . substr($row->postal_code, 3);
        });

        return $template;
    }

    private function nbsp($text) {
        if (!$text) {
            return '';
        }
        $words = [
            'cs' => ['a', 'i', 'à', 'během', 'bez', 'beze', 'blízko', 'cestou', 'dík', 'díky', 'dle', 'do', 'jménem', 'k', 'ke', 'kol', 'kolem', 'krom', 'kromě', 'ku', 'kvůli', 'mezi', 'mimo', 'místo', 'na', 'nad', 'nade', 'namísto', 'naproti', 'navzdory', 'nedaleko', 'o', 'ob', 'od', 'ode', 'ohledně', 'okolo', 'oproti', 'po', 'poblíž', 'pod', 'pode', 'podél', 'podle', 'podlevá', 'podlivá', 'pomocí', 'před', 'přede', 'přes', 'přese', 'při', 'pro', 'prostřednictvím', 'proti', 'skrz', 'skrze', 'stran', 'u', 'u příležitosti', 'uprostřed', 'v', 'včetně', 've', 'vedle', 'versus', 'vinou', 'vis-à-vis', 'vlivem', 'vně', 'vo', 'vod', 'vstříc', 'vůči', 'vůkol', 'vz', 'vzdor', 'vzhledem k', 'z', 'za', 'ze', 'zkraje', 'zpod', 'zpoza', 's', 'se'],
            'en' => ['a', 'the', 'and', 'during', 'without', 'without', 'close', 'way', 'thanks', 'Thanks', 'according to', 'to', 'on behalf of', 'to', 'ke', 'kol', 'around', 'except', 'except', 'ku', 'due to', 'between', 'outside', 'place', 'on', 'over', 'nade', 'instead of', 'opposite', 'despite', 'nearby', 'O', 'ob', 'from', 'ode', 'regarding', 'about', 'versus', 'after', 'near', 'under', 'pode', 'along', 'according to', 'sucks', 'podlivá', 'help', 'before', 'prede', 'over', 'over', 'at', 'for', 'through', 'against', 'with', 'se', 'through', 'through', 'hillside', 'at', 'on the occasion', 'in the middle', 'in', 'including', 've', 'next to', 'versus', 'guilt', 'vis-à-vis', 'influence', 'outside', 'vo', 'waters', 'accommodate', 'against', 'round', 'vz', 'defiance', 'due to', 'from', 'of', 'for', 'that', 'shortly', 'from under', 'from behind']
        ];
        foreach ([' ', '>', "\n", '('] as $whiteCharacter) {
            foreach ($words[$this->language] as $word) {
                $text = str_replace($whiteCharacter . $word . ' ', $whiteCharacter . $word . '&nbsp;', $text);
            }
            foreach ($words[$this->language] as $word) {
                $wordWithFirstLetterUppercase = $this->mbUcFirst($word);
                $text = str_replace($whiteCharacter . $wordWithFirstLetterUppercase . ' ', $whiteCharacter . $wordWithFirstLetterUppercase . '&nbsp;', $text);
            }
        }
        $text = str_replace(' Kč', '&nbsp;Kč', $text);
        return $text;
    }

    protected function mbUcFirst($s) {
        if (!$s) {
            return $s;
        }
        return mb_strtoupper(mb_substr($s, 0, 1)) . mb_substr($s, 1);
    }

    protected function truncateWords($text, $length) {
        if (!$text) {
            return null;
        }
        $text = html_entity_decode(strip_tags($text, '<br>'));
        $parts = preg_split('/([\s\n\r]+)/u', $text, -1, PREG_SPLIT_DELIM_CAPTURE);
        $partsCount = count($parts);
        $actualLength = 0;
        for ($lastPart = 0; $lastPart < $partsCount; ++$lastPart) {
            $actualLength += mb_strlen($parts[$lastPart]);
            if ($actualLength > $length) {
                break;
            }
        }
        $result = rtrim(implode(array_slice($parts, 0, $lastPart)));
        return $result . (mb_strlen($text) > $length ? '...' : '');
    }

    function makeBootstrap4(Form $form): void {
        $renderer = $form->getRenderer();
        $renderer->wrappers['controls']['container'] = null;
        $renderer->wrappers['pair']['container'] = 'div class="form-group row"';
        $renderer->wrappers['pair']['.error'] = 'has-danger';
        $renderer->wrappers['control']['container'] = 'div class=col-sm-12';
        $renderer->wrappers['label']['container'] = 'div class="col-sm-12 col-form-label"';
        $renderer->wrappers['control']['description'] = 'span class=form-text';
        $renderer->wrappers['control']['errorcontainer'] = 'span class=form-control-feedback';
        $renderer->wrappers['control']['.error'] = 'is-invalid';

        foreach ($form->getControls() as $control) {
            $type = $control->getOption('type');
            if ($type === 'button') {
                $control->getControlPrototype()->addClass(empty($usedPrimary) ? 'btn btn-primary' : 'btn btn-secondary');
                $usedPrimary = true;
            } elseif (in_array($type, ['text', 'textarea', 'select'], true)) {
                $control->getControlPrototype()->addClass('form-control tepic');
                if ($type === 'text') {
                    $control->getControlPrototype()->addClass('tepic');
                }
            } elseif ($type === 'file') {
                $control->getControlPrototype()->addClass('form-control-file');
            } elseif (in_array($type, ['checkbox', 'radio'], true)) {
                if ($control instanceof Nette\Forms\Controls\Checkbox) {
                    $control->getLabelPrototype()->addClass('form-check-label');
                } else {
                    $control->getItemLabelPrototype()->addClass('form-check-label');
                }
                $control->getControlPrototype()->addClass('form-check-input');
                $control->getSeparatorPrototype()->setName('div')->addClass('form-check');
            }
        }
    }

    protected function containsForbiddenWords($text) {
        foreach (['[url=', 'http', 'www', 'mаlwarе', 'billion', 'CLICK BELOW', 'fund to you', '@', ' fuck', ' sex', ' porn', ' drugs', 'Check out our', 'Questions?', 'more clients', 'bit.ly', 'vyplacena'] as $string) {
            if (stripos($text, $string) !== false) {
                return true;
            }
        }
        return false;
    }

    protected function isSpam($name) {
        if ($this->containsForbiddenWords($name)) {
            return true;
        }
        if (preg_match_all('/[aáâàåäðeéêèëěiíîìïyыŷýÿŸŶoóôòøõöuúûùüůæçß]/iu', $name) / strlen($name) * 100 < 20) {
            return true;
        }
        if (preg_match('/[^aáâàåäðeéêèëěiíîìïyыŷýÿŸŶoóôòøõöuúûùüůæçß]{4,}/iu', $name)) {
            return true;
        }
        $firstIsUppercase = preg_match('/^\p{Lu}/u', $name);
        if (!$firstIsUppercase && strlen(preg_replace('/[^A-Z]+/u', '', $name)) || $firstIsUppercase && preg_match('/\p{Lu}$/u', $name)) {
            return true;
        }
        $name = str_replace('q', 'Q', $name);
        $name = str_replace('w', 'W', $name);
        $name = str_replace('x', 'X', $name);
        if (strlen(preg_replace('/[^A-Z]+/u', '', $name)) > 2) {
            return true;
        }
        return false;
    }

    public function overrideEmail($mail) {
        if (Debugger::$productionMode == Debugger::DEVELOPMENT && isset($this->parameters['overrideEmail'])) {
            return $this->parameters['overrideEmail'];
        }
        return $mail;
    }

    protected function getIp() {
        return $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['HTTP_X_REAL_IP'] ?? $_SERVER['REMOTE_ADDR'];
    }

    protected function createComponentContactForm(): UI\Form {
        $form = new UI\Form;
        $form->onRender[] = function (Form $form) {
            $this->makeBootstrap4($form);
        };
        $form->addText('name', $this->texts['YOUR_NAME'], null, 63)
                ->setRequired()
                ->setHtmlAttribute('placeholder', $this->texts['YOUR_NAME']);
        $form->addText('phone', $this->texts['PHONE_LABEL'], null, 32)
                ->setRequired()
                ->setHtmlAttribute('placeholder', $this->texts['PHONE_LABEL']);
        $form->addText('email', $this->texts['EMAIL_LABEL'], null, 63)
                ->setRequired()
                ->setHtmlAttribute('placeholder', $this->texts['EMAIL_LABEL'])
                ->addRule(Form::EMAIL);
        $form->addTextArea('message', $this->texts['WHAT_DO_YOU_NEED_TO_SOLVE'], null, 1)
                ->setRequired()
                ->setHtmlAttribute('placeholder', $this->texts['WHAT_DO_YOU_NEED_TO_SOLVE']);
        if ($this->action == 'cleaningPlant') {
            $form['message']->setDefaultValue('Mám zájem o více informací k ' . $this->template->cleaningPlant->name . '.');
        }
        $form->addSubmit('submit', $this->texts['SEND_MESSAGE']);
        $form->onSuccess[] = [$this, 'contactFormSucceeded'];
        $form->setAction($this->link($this->presenter->name == 'Error4xx' ? 'Homepage:default' : 'this'));
        return $form;
    }

    public function contactFormSucceeded(UI\Form $form, \stdClass $values): void {
        if (!$this->isSpam($values->name)) {
            $mail = new Message;
            $mail->setFrom($values->email, $values->name)
                    ->addTo($this->overrideEmail('lenka.subertova@gutra.cz'))
                    ->setSubject('Gutra - kontaktní formulář')
                    ->setBody(
"Dobrý den,

na webu gutra.cz byl vyplněn kontaktní formulář s následujícími údaji:

Jméno: $values->name
Email: $values->email
Telefon: $values->phone
Zpráva:

$values->message"
            );
            $mailer = new SendmailMailer;
            try {
                $mailer->send($mail);
                $sent = true;
            } catch (SendException $exc) {
                $sent = false;
            }
            $this->db->table('contact_form')->insert([
                'name' => $values->name,
                'email' => $values->email,
                'phone' => $values->phone,
                'text' => $values->message,
                'sent' => $sent
            ]);
            $this->redirect('messageSent');
        }
        if ($this->presenter->name == 'Error') {
            $this->redirect('Homepage:default');
        }
        $this->redirect('this');
    }

    protected function config($key) {
        return $this->db->table('config')
                ->select('value')
                ->where('key', $key)
                ->fetchField();
    }

}
