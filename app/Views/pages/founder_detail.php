<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <!-- Open Graph / Facebook -->
    <meta
      property="og:image"
      content="https://automateall.id/img/vector/automateall-meta.jpg"
    />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="750" />
    <meta property="og:image:height" content="690" />
    <title>Detail Person</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Biryani:wght@600;700;800;900&family=Varela&display=swap"
      rel="stylesheet"
    />
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      html {
        font-size: 62.5%;
      }
      ::-moz-selection { /* Code for Firefox */
        background: rgba(248,189,127,.3);
      }
        
      ::selection {
        background: rgba(248,189,127,.3);
      }
      .founder {
        font-family: "Biryani", sans-serif;
        height: 100vh;
        overflow: auto;
      }

      .founder header {
        padding: 5rem 1rem 1.5rem;
        display: flex;
        flex-direction: column;
        place-items: center;
        background-color: #0f4c75;
        margin-bottom: 2rem;
      }
      .founder__ava-img {
        flex-basis: 15rem;
        height: 15rem;
        border-radius: 10%;
        box-sizing: border-box;
      }
      .founder__name {
        font-size: 2.4rem;
        font-weight: 800;
        background-image: linear-gradient(to left, #fdbd28, #ffdb4d);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-align: center;
        margin-top: 2rem;
        margin-bottom: 0;
        width: 90%;
        line-height: 3.7rem;
      }
      .founder__about {
        font-family: "Varela", sans-serif;
        font-size: 1.4rem;
        color: #90acbf;
        text-align: center;
        width: 95%;
        margin-top: 2.5rem;
        margin-bottom: 0;
      }
      .founder__about strong {
        color: #e5e4e2;
      }
      .founder main {
        display: flex;
        flex-direction: column;
        place-items: center;
        gap: 1.2rem;
        margin-bottom: 1.5rem;
      }
      .founder__link {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        background-color: #f4f0ec;
        width: 80%;
        text-decoration: none;
        padding: 1rem 2rem;
        border-radius: 1rem;
        -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12),
          0 1px 2px rgba(0, 0, 0, 0.24);
        -moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12),
          0 1px 2px rgba(0, 0, 0, 0.24);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        position: relative;
      }

      .founder__link img {
        width: 4rem;
        height: 4rem;
      }
      .founder__link p {
        font-family: "Varela", sans-serif;
        font-size: 2rem;
        color: #000;
        flex-grow: 1;
      }
      .founder__our-web {
        text-align: center;
      }
      .founder__our-web img {
        width: 10rem;
      }

      .founder .copy-email {
        width: 3rem;
        height: 3rem;
      }
      #tooltip {
        position: relative;
        display: none;
        color: #fff;
        padding: 1rem 1rem 0.5rem;
        border-radius: 1rem;
        background-color: #333;
      }

      @media (min-width: 576px) {
        .founder__name {
          width: 100%;
        }
        .founder__link {
          width: 65%;
        }
      }
      @media (min-width: 768px) {
        .founder__name {
            font-size:3rem;
        }
        .founder__about{
            font-size:2rem;
        }
        .founder__about {
          font-size: 2.2rem;
          width: 75%;
        }
        .founder main {
          flex-direction: row;
          padding: 0 1.5rem;
        }
        .founder__link {
          flex-direction: column;
          text-align: center;
          height: 13rem;
          justify-content: center;
          padding: 1rem;
        }
        .founder__link:hover {
          -webkit-box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
            0 10px 10px rgba(0, 0, 0, 0.22);
          -moz-box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
            0 10px 10px rgba(0, 0, 0, 0.22);
          box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
            0 10px 10px rgba(0, 0, 0, 0.22);
        }
        
        .founder__link p {
          font-size: 1.6rem;
          height: 4.5rem;
        }
        .founder__link img {
          width: 5rem;
          height: 5rem;
        }
        .founder__our-web {
          position: absolute;
          text-align: center;
          top: 2rem;
          right: 2rem;
        }
        .founder__our-web img {
          width: 13rem;
        }
        .founder .copy-email {
          display: none;
          top: 1rem;
          right: 1rem;
          position: absolute;
        }
        #linkedin{
            order: 3;
        }
        #portofolio{
            order: 2;
        }
        #ig {
            order: 1;
        }
        
        #send-mail{
            order: 3;
        }
        
        #wa{
            order: 3;
        }
    
        #send-mail:hover .copy-email {
          display: block;
        }
      }
      @media (min-width: 992px) {
        .founder__about {
          width: 55%;
        }
        .founder__our-web img {
          width: 16rem;
        }
        .founder__link {
          height: 16rem;
        }
        .founder__link p {
          font-size: 2rem;
        }
        .founder__link img {
          width: 6rem;
          height: 6rem;
        }
      }
    </style>
  </head>
  <body>
    <?php if(empty($nama)==false){?>
        <section class="founder">
          <header>
            <img
              class="founder__ava-img"
              src="/img/founder/ava/<?=$ava;?>"
              alt="Founder Avatar"
            />
            <h2 class="founder__name"><?= $nama; ?></h2>
            <h3 class="founder__about">
              <?= $about; ?>
            </h3>
          </header>
          <main>
            <a href="<?= $linkedin; ?>" target="_blank" class="founder__link" id="linkedin">
              <img
                srcset="/img/founder/socials/linkedin-2x.png 2x, /img/founder/socials/linkedin.png 1x"
                src="/img/founder/socials/linkedin.png"
                alt="Linkedin Icon"
              />
              <p>Visit my LinkedIn</p>
            </a>
        <?php if(empty($porto) == false){?>
            <a href="$porto" target="_blank" class="founder__link" id="portofolio">
        <?php } else { ?>
            <a href="#" class="founder__link" id="portofolio">
        <?php };?>
              <img
                srcset="/img/founder/socials/dribble-2x.png 2x, /img/founder/socials/dribble.png 1x"
                src="/img/founder/socials/dribble.png"
                alt="Dribble Icon"
              />
              <p>View my Portofolio</p>
            </a>
            <a href="<?= $ig;?>" target="_blank" class="founder__link" id="ig">
              <img
                srcset="/img/founder/socials/instagram-2x.png 2x, /img/founder/socials/instagram.png 1x"
                src="/img/founder/socials/instagram.png"
                alt="Instagram Icon"
              />
              <p>Follow me on Instagram</p>
            </a>
            <a
              href="mailto:<?= $email;?>"
              target="_blank"
              class="founder__link"
              id="send-mail"
            >
              <img
                srcset="/img/founder/socials/mail-2x.png 2x, /img/founder/socials/mail.png 1x"
                src="/img/founder/socials/mail.png"
                alt="Email Icon"
              />
              <p>Send me Emails</p>
              <picture data-mail="<?= $email;?>">
                <source srcset="/img/founder/socials/copy.png" media="(min-width:768px)" alt="copy" />
                <img src="/img/founder/socials/will-be-copied.png" class="copy-email" alt="copy" />
              </picture>
            </a>
            <div id="tooltip"></div>
            <a href="<?= $wa;?>" target="_blank" class="founder__link" id="wa">
              <img
                srcset="/img/founder/socials/whatsapp-2x.png 2x, /img/founder/socials/whatsapp.png 1x"
                src="/img/founder/socials/whatsapp.png"
                alt="WhatsApp Icon"
              />
              <p>WhatsApp me</p>
            </a>
          </main>
          <div class="founder__our-web">
            <a href="https://automateall.id">
              <picture>
                <source
                  srcset="/img/founder/socials/startup-white.jpg"
                  media="(min-width:768px)"
                  alt="Logo Automate All"
                />
                <img src="/img/founder/socials/startup.png" alt="Logo Automate All" />
              </picture>
            </a>
          </div>
        </section>
    <?php }; ?>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script>
      const pictureEl = document
        .getElementById("send-mail")
        .querySelector("picture");
      pictureEl.addEventListener("mouseover", function () {
        this.children[0].setAttribute("srcset", "/img/founder/socials/will-be-copied.png");
      });
      pictureEl.addEventListener("mouseout", function () {
        this.children[0].setAttribute("srcset", "/img/founder/socials/copy.png");
      });

      const tooltip = document.getElementById("tooltip");
      pictureEl.addEventListener("click", async function (e) {
        e.preventDefault();
        e.stopPropagation();
        const email = this.dataset.mail;

        if (navigator.clipboard) {
          await navigator.clipboard.writeText(email);
          tooltip.textContent = "Copied!";
          tooltip.style.display = "inline-block";
          Popper.createPopper(this.parentElement, tooltip, {
            placement: "top-end",
            modifiers: [
              {
                name: "offset",
                options: {
                  offset: [0, 6],
                },
              },
            ],
          });
          setTimeout(() => (tooltip.style.display = ""), 1500);
        } else {
          
          tooltip.textContent = email;
          tooltip.style.display = "inline-block";
          Popper.createPopper(this.parentElement, tooltip, {
            placement: "top-end",
            modifiers: [
              {
                name: "offset",
                options: {
                  offset: [0, 6],
                },
              },
            ],
          });
          setTimeout(() => (tooltip.style.display = ""), 4000);
        }
      });
      
    </script>
  </body>
</html>
