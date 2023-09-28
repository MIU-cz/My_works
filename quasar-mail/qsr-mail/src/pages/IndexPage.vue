<!-- 
Data obdržená z API:    
subject: string;    
text: string;    
fromAddress: string;    
toAddresses: string[];    
ccAddresses: string[];    
bccAddresses: string[];    
direction: EmailDirectionApi;    
messageDt: Date; 

mytaskdev@gmail.com
name+2023
-->

<template>
  <q-page class="flex flex-center">
    <EmailList :emails="emails" />
  </q-page>
</template>

<script>
import EmailList from "src/components/EmailList.vue";
import { defineComponent } from "vue";

const imap = require("imap");
const email = require("emailjs");

export default defineComponent({
  name: "IndexPage",
  components: { EmailList },
  data() {
    return {
      emails: [],
    };
  },

  methods: {
    mounted() {
      const client = new imap({
        user: "mytaskdev@gmail.com",
        password: "mytaskdev2023",
        host: "imap.gmail.com",
        port: 993,
        tls: true,
      });

      client.connect();

      client.on("ready", () => {
        client.openBox("INBOX", false, (err, box) => {
          if (err) {
            console.error(err);
            return;
          }

          client.search(["ALL"], (err, results) => {
            if (err) {
              console.error(err);
              return;
            }

            const stream = client.fetch(results, {
              bodies: "",
              struct: false,
            });

            stream.on("message", (msg, seqno) => {
              const email = {};
              msg.on("body", (stream, info) => {
                let body = "";

                stream.on("data", (chunk) => {
                  body += chunk.toString("utf8");
                });

                stream.on("end", () => {
                  const parsed = email.message(body);
                  const headers = parsed.headers;

                  email.fromAddress = headers.from;
                  email.subject = headers.subject;
                  email.messageDt = headers.date;
                  email.text = parsed.text;
                });
              });

              msg.on("end", () => {
                this.emails.push(email);
              });
            });

            stream.on("end", () => {
              client.end();
            });
          });
        });
      });

      client.on("error", (err) => {
        console.error(err);
      });

      client.on("close", () => {
        console.log("Connection closed");
      });
    },
  },
});


</script>
