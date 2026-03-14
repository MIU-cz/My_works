<?php

declare(strict_types=1);

namespace App\Presenters;

final class HomepagePresenter extends BasePresenter {

    public function renderDefault() {
        $this->template->slider = $this->db->table('slide')->select('*, title_' . $this->language . ' title, text_' . $this->language . ' text')->where(['microsite_id' => $this->micrositeId, 'display' => 1])->order('order')->fetchAll();
        $this->loadNews();
    }

    public function renderNews() {
        $this->loadNews();
    }

    public function renderNewsArticle($id) {
        preg_match('/(\d+)\-(.+)/', $id, $matches);
        if (!isset($matches[1]) || !($this->template->newsArticle = $this->db->table('news_article')
                ->select('*, title_' . $this->language . ' title, url_' . $this->language . ' url, text_' . $this->language . ' text')
                ->where('microsite_id', $this->micrositeId)
                ->where('display')
                ->where('date <= CURDATE()')
                ->where('title_' . $this->language . ' > ""')
                ->get($matches[1]))
        ) {
            $this->redirect('news');
        }
        if (!isset($matches[2]) || $this->template->newsArticle->url != $matches[2]) {
            $this->redirectPermanent('newsArticle', ['id' => $matches[1] . '-' . $this->template->newsArticle->url]);
        }
        $this->template->meta = new \stdClass();
        $this->template->meta->og_type = 'article';
        $this->template->meta->og_title = $this->template->meta->title = $this->template->newsArticle->title;
        $this->template->meta->og_description = $this->template->meta->description = $this->truncateWords($this->template->newsArticle->text, 150);
        $this->template->meta->og_image = $this->template->image = $this->mainWebsiteUrl . '/images/news/' . $this->micrositeId . '/' . $this->template->newsArticle->id . '.' . $this->template->newsArticle->image_extension;
    }

    public function renderServices() {
        $this->loadServices(7);
    }

    public function renderEquipment() {
        $this->loadServices(8);
    }

    public function renderContact() {
        $this->template->contactCategories = $this->db->table('contact_category')
                ->select('id, name_' . $this->language . ' name, url_' . $this->language . ' url')
                ->where('microsite_id', $this->micrositeId)
                ->order('id')
                ->fetchAll('id');
        $this->template->contacts = $this->db->table('contact')
                ->select('*, function_' . $this->language . ' function')
                ->where('category_id', array_keys($this->template->contactCategories))
                ->order('order')
                ->fetchAll();
    }

    public function renderSitemap() {
        $this->getHttpResponse()->setContentType('text/xml');
        $this->template->urls = array_keys(
                $this->db->table('page_meta')
                    ->where('microsite_id', $this->micrositeId)
                    ->where('url != "nabidka"')
                    ->order('url')
                    ->fetchAssoc('url->')
        );
        $this->template->jobs = $this->db->table('job')
                ->select('url_' . $this->language . ' url')
                ->where('microsite_id', $this->micrositeId)
                ->where('display')
                ->order('order')
                ->fetchAll();
        $this->loadNews('id, url_' . $this->language . ' url');
    }

    private function loadServices($id, $withText = true) {
        $sql = 'SELECT service.id, name_' . $this->language . ' name' . ($withText ? ', text_' . $this->language . ' text, catalog_2_url_' . $this->language . ' catalog_2_url' : '') . ', (SELECT CONCAT(id, ".", image_extension, "?v=", image_version) FROM service_image WHERE service_id = service.id ORDER BY `order` LIMIT 1) image_filename '
                . 'FROM service '
                . 'JOIN service_category ON service_category.id = category_id '
                . 'WHERE microsite_id = ? '
                . 'AND category_id = ? '
                . 'ORDER BY `order`';
        $this->template->{$id == 8 ? 'products' : 'services'} = $this->db->query($sql, $this->micrositeId, $id)->fetchAll();
    }

    //MIU aktuálně - slider:
    private function loadNews($columns = null) {
        $this->template->newsArticles = $this->db->table('news_article')
                ->select($columns ?: 'id, date, title_' . $this->language . ' title, text_' . $this->language . ' text, url_' . $this->language . ' url, image_extension')
                ->where('microsite_id', $this->micrositeId)
                ->where('display')
                ->where('public')
                ->where('title_' . $this->language . ' > ""')/*->where('text_' . $this->language . ' > ""')*/
                ->order('date DESC')
                ->fetchAll();
    }

    public function renderFiles() {
        $this->template->fileCategories = [0 => '']
                + $this->db->table('file_category')
                ->select('id, name_' . $this->language . ' name')
                ->where('microsite_id', $this->micrositeId)
                ->order('name_' . $this->language)
                ->fetchPairs('id', 'name');
        $this->template->filesByCategories = [];
        $sql = "SELECT f.id, f.name, f.url, category_id "
                . "FROM file f "
                . "LEFT JOIN file_category fc ON fc.id = category_id "
                . "WHERE f.microsite_id = ? "
                . "AND !IFNULL(fc.with_qr, 0) "
                . "AND (language IS NULL or language = ?) "
                . "ORDER BY f.`order`";
        $files = $this->db->query($sql, $this->micrositeId, $this->language)->fetchAll();
        foreach ($files as $file) {
            $key = $file->category_id ?: 0;
            if (!isset($this->template->filesByCategories[$key])) {
                $this->template->filesByCategories[$key] = [];
            }
            $this->template->filesByCategories[$key][] = $file;
        }
    }

    public function renderDownloadFile($id) {
        if (!($file = $this->db->table('file')->select('name, file_extension')->where('microsite_id', $this->micrositeId)->get($id))) {
            $this->redirect('Homepage:default');
        }
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Expires: Sat, 1 Jan 2000 00:00:00 GMT');
        header('Pragma: no-cache');
        header('Content-Type: ' . ($file->file_extension == 'pdf' ? 'application/pdf' : 'image/' . $file->file_extension));
        header('Content-Disposition: inline; filename*=UTF-8\'\'' . rawurlencode($file->name) . '.' . $file->file_extension . ';');
        readfile($this->mainWebsiteUrl . '/files/' . $this->micrositeId . '/' . $id . '.' . $file->file_extension);
        exit;
    }

    public function actionCleaningPlant($id) {
        $this->template->cleaningPlant = $this->db->table('branch')
                ->select('*, name_' . $this->language . ' name, text_' . $this->language . ' text, (SELECT CONCAT(id, ".", image_extension) FROM branch_image WHERE branch_id = branch.id ORDER BY `order` LIMIT 1) image_filename')
                ->where('microsite_id', $this->micrositeId)
                ->where('name_' . $this->language . ' > ""')
                ->where('text_' . $this->language . ' > ""')
                ->where('url_' . $this->language, $this->getParameter('id'))
                ->fetch();
        if (!$this->template->cleaningPlant) {
            $this->redirect('services');
        }
        $this->template->meta = new \stdClass();
        $this->template->meta->og_type = 'article';
        $this->template->meta->og_title = $this->template->meta->title = $this->template->cleaningPlant->name;
        $this->template->meta->og_description = $this->template->meta->description = $this->truncateWords($this->template->cleaningPlant->text, 150);
        $this->template->meta->og_image = $this->template->image = $this->mainWebsiteUrl . '/images/branches/' . $this->micrositeId . '/' . $this->template->cleaningPlant->id . '/' . $this->template->cleaningPlant->image_filename;
    }

    public function renderCareer() {
        $this->template->jobs = $this->db->table('job')
                ->select('*, title_' . $this->language . ' title, url_' . $this->language . ' url, text_' . $this->language . ' text')
                ->where('microsite_id', $this->micrositeId)
                ->where('display')
                ->where('title_' . $this->language . ' > ""')
                ->order('order');
    }

    public function renderJob($id) {
        if (!($this->template->job = $this->db->table('job')->select('*, title_' . $this->language . ' title, text_' . $this->language . ' text')->where(['microsite_id' => $this->micrositeId, 'display' => 1])->where('title_' . $this->language . ' > ""')->where('url_' . $this->language, $id)->fetch())) {
            $this->redirect('jobs');
        }
        $this->template->meta = new \stdClass();
        $this->template->meta->og_type = 'article';
        $this->template->meta->title = $this->template->meta->og_title = $this->template->job->title;
        $this->template->meta->description = $this->template->meta->og_description = $this->truncateWords($this->template->job->text, 150);
    }

}
