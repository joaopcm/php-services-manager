<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang='pt_br'>

<head>
  <meta class="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title><?php echo getenv('APP_NAME'); ?> - Sistema de gerenciamento empresarial</title>
  <link rel='stylesheet' href='\assets/css/site/style.min.css' />
</head>

<body>
  <div class="navbar navbar--extended">
    <nav class="nav__mobile"></nav>
    <div class="container">
      <div class="navbar__inner">
        <a href="index.html" class="navbar__logo"><?php echo getenv('APP_NAME'); ?></a>
        <nav class="navbar__menu">
          <ul>
            <li><a href="<?php echo getenv('APP_URL'); ?>login">Entrar</a></li>
            <li><a href="<?php echo getenv('APP_URL'); ?>registrar">Registrar-se</a></li>
          </ul>
        </nav>
        <div class="navbar__menu-mob"><a href="" id='toggle'><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
              <path fill="currentColor" d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z" class=""></path>
            </svg></a></div>
      </div>
    </div>
  </div>
  <div class="hero">
    <div class="hero__overlay hero__overlay--gradient"></div>
    <div class="hero__mask"></div>
    <div class="hero__inner">
      <div class="container">
        <div class="hero__content">
          <div class="hero__content__inner" id='navConverter'>
            <h1 class="hero__title">Um sistema completo para sua gestão</h1>
            <p class="hero__text"><?php echo getenv('APP_NAME'); ?> é um projeto que possibilida seus usuários a gerir clientes, serviços, pagamentos, consultas e entre outras grandes funcionalidades.</p>
            <a href="#" class="button button__accent">Adquirir licença</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="hero__sub">
    <span id="scrollToNext" class="scroll">
      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" class='hero__sub__down' fill="currentColor" width="512px" height="512px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
        <path d="M256,298.3L256,298.3L256,298.3l174.2-167.2c4.3-4.2,11.4-4.1,15.8,0.2l30.6,29.9c4.4,4.3,4.5,11.3,0.2,15.5L264.1,380.9c-2.2,2.2-5.2,3.2-8.1,3c-3,0.1-5.9-0.9-8.1-3L35.2,176.7c-4.3-4.2-4.2-11.2,0.2-15.5L66,131.3c4.4-4.3,11.5-4.4,15.8-0.2L256,298.3z" /></svg>
    </span>
  </div>
  <div class="steps landing__section">
    <div class="container">
      <h2>Quem pode usar o <?php echo getenv('APP_NAME'); ?>?</h2>
      <p>Criado desde o começo para empresas que buscam uma organização extrema.</p>
    </div>
    <div class="container">
      <div class="steps__inner">
        <div class="step">
          <div class="step__media">
            <img src="\assets/img/site/undraw_startup_life_2du2.svg" class="step__image">
          </div>
          <h4>Startups</h4>
          <p class="step__text">Pequenas empresas têm a chance de possuir um sistema que garante um vínculo com o cliente.</p>
        </div>
        <div class="step">
          <div class="step__media">
            <img src="\assets/img/site/undraw_product_tour_foyt.svg" class="step__image">
          </div>
          <h4>Médias e grandes empresas</h4>
          <p class="step__text">Independente do tamanho da sua empresa, temos certeza que o <?php echo getenv('APP_NAME'); ?> irá ajudar na sua gestão.</p>
        </div>
        <div class="step">
          <div class="step__media">
            <img src="\assets/img/site/undraw_creation.svg" class="step__image">
          </div>
          <h4>Autônomos</h4>
          <p class="step__text">Cuidar de um negócio sozinho não é muito prático. É nessa parte que o <?php echo getenv('APP_NAME'); ?> te ajuda.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="expanded landing__section">
    <div class="container">
      <div class="expanded__inner">
        <div class="expanded__media">
          <img src="\assets/img/site/undraw_browser.svg" class="expanded__image">
        </div>
        <div class="expanded__content">
          <h2 class="expanded__title">Uma incrível interface fácil de entender</h2>
          <p class="expanded__text">O <?php echo getenv('APP_NAME'); ?> te oferece um painel com dados analíticos da sua empresa, como engajamento de clientes, engajamento de pagamentos, informações monetárias, etc. Tudo isso para manter você informado sobre o seu negócio.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="expanded landing__section">
    <div class="container">
      <div class="expanded__inner">
        <div class="expanded__media">
          <img src="\assets/img/site/undraw_newsletter_vovu.svg" class="expanded__image">
        </div>
        <div class="expanded__content">
          <h2 class="expanded__title">O seu tempo é importante para nós</h2>
          <p class="expanded__text"><?php echo getenv('APP_NAME'); ?> cuida dos e-mails que você enviaria para cada cliente ao alterar qualquer informação. O próprio sistema mantém um contato automático com o cliente por meio de e-mails para mantê-lo sempre bem informado.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="expanded landing__section">
    <div class="container">
      <div class="expanded__inner">
        <div class="expanded__media">
          <img src="\assets/img/site/undraw_news_go0e.svg" class="expanded__image">
        </div>
        <div class="expanded__content">
          <h2 class="expanded__title">Sempre inovando com você</h2>
          <p class="expanded__text">Nossa equipe está sempre mantendo a ferramenta atualizada e implementando novas funcionalidades para suprir todas as necessidades de uma empresa.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="cta cta--reverse">
    <div class="container">
      <div class="cta__inner">
        <h2 class="cta__title">Junte-se a nós agora</h2>
        <p class="cta__sub cta__sub--center">Eleve o nível do seu negócio com <?php echo getenv('APP_NAME'); ?>.</p>
        <a href="#" class="button button__accent">Adquirir licença</a>
      </div>
    </div>
  </div>
  <div class="footer footer--dark">
    <div class="container">
      <div class="footer__inner">
        <a href="" class="footer__textLogo"><?php echo getenv('APP_NAME'); ?></a>
        <div class="footer__data">
          <div class="footer__data__item">
            <div class="footer__row">
              Desenvolvido por <a href="https://www.sourcess.com.br/" target="_blank" class="footer__link">Sourcess Development</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src='\assets/js/site/app.min.js'></script>
</body>

</html>