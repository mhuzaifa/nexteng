<?php

$current_page = 'home-page';
$current_body_class = 'home';
/*
  IF IS AJAX
  Get the ID of the page/post from query_var and setup post data to use like a regular page
*/
if(get_query_var( 'ajax-id' )) :
  $id = get_query_var( 'ajax-id' );
  global $post;
  $post = get_post($id);
  setup_postdata($post);
endif;


if( class_exists('BuroWordpress') ) {
  $mobile_info = buro_get_mobile();
}
else {
  $mobile_info['type'] = '';
}

if( $mobile_info['type'] == 'phone') $phone = 'phone'; else $phone = '';
if( $mobile_info['type'] == 'tablet') $tablet = 'tablet'; else $tablet = '';

//HOME CONTENT

?>

<!-- ============= CONTENT ============= -->
<div class="page-main page-current">
  <div class="page-toload home-page" data-bodyclass="home">
    <!--HERE IS THE FIXED MENU WHITE-->
    <!--  <ul style="position:fixed;z-index:222">

      <li><a>sdsfds</a></li>
      <li><a href="#ser-next">sdsfds</a></li>
      <li><a href="#manifesto">sdsfds</a></li>
      <li><a href="#areas">sdsfds</a></li>
      <li><a href="#setores">sdsfds</a></li>
    </ul> -->
    <header class="page-header header-purple" id="intro">
      <div class="header">
        <nav class="menu menu-full">
          <?php include 'menu.php';?>
        </nav>

        <article class="carousel-wrapper">
          <div class="carousel-content inspire">
            <img class="carousel--img" src="public/imgs/inspire.jpg">
            <div class="logo-container">
              <svg id="logo" viewBox="0 0 1000 202">
                <style>
                  .st0 {
                    fill: #fff
                  }
                </style>
                <path id="tr_1_" d="M901.4 197.3h-24.8c-7.9 0-14.9-.5-20.9-1.6-6-1.1-11.2-2.6-15.5-4.6-8.4-4.3-14.3-11.2-17.5-20.8-3.2-9.6-4.8-22.4-4.8-38.5V82.5h-26.4V42c3 0 5.7-.1 7.9-.4 2.2-.3 4.7-.7 7.4-1.2 5-.7 8.6-2.4 10.9-5 2.3-2.6 3.7-7.2 4.4-13.8.4-3.2.7-6.7 1-10.6.3-3.8.5-5 .7-8.2h40.4v36.5h37.2v43.2h-37.2v39.7c0 4.5.2 8.4.5 11.7.4 3.3.8 6 1.3 8.2 1.4 4.1 4.1 6.8 7.9 8 3.9 1.3 9.6 1.9 17.4 1.9h10v45.3z"
                  class="st0" />
                <path id="tr" d="M911.8 28.3c-3-2.6-4.5-6.5-4.5-11.5v-.7c0-1.6.2-3.1.5-4.5.4-1.4.9-2.7 1.5-3.9 1.4-2.4 3.3-4.2 5.7-5.5 2.4-1.3 5.1-1.9 8.1-1.9 1.5 0 2.9.1 4.2.5 1.3.3 2.6.8 3.8 1.4 2.4 1.3 4.3 3.1 5.7 5.4 1.4 2.3 2.2 5.2 2.2 8.5v.8c0 1.7-.2 3.2-.5 4.6-.4 1.4-.9 2.7-1.6 3.8-1.4 2.3-3.3 4.1-5.7 5.3-2.4 1.2-5 1.8-8 1.8-4.6-.2-8.4-1.5-11.4-4.1zm20.7-2c2.4-2.2 3.6-5.4 3.6-9.6v-.5c0-4.2-1.2-7.4-3.7-9.7-2.5-2.4-5.6-3.5-9.4-3.5-3.7 0-6.8 1.2-9.2 3.6-2.4 2.4-3.7 5.6-3.7 9.7v.4c0 4.1 1.2 7.3 3.7 9.6 2.4 2.2 5.6 3.4 9.4 3.4 3.8-.1 6.9-1.2 9.3-3.4zM920 18.1v6.1h-2.8V7.9h6.6c2.3 0 3.9.4 4.9 1.3 1 .9 1.4 2 1.4 3.5 0 1.2-.3 2.1-.8 2.8-.6.7-1.4 1.2-2.5 1.4 1.1.2 1.8.6 2.2 1.2.4.6.7 1.6.7 2.8v2.4c0 .2 0 .3.1.5 0 .1.1.3.2.4h-2.9c0-.1-.1-.1-.1-.3V21c0-1-.2-1.8-.6-2.2-.4-.4-1.3-.6-2.8-.6H920zm6.4-3.1c.6-.5.9-1.3.9-2.3 0-.8-.3-1.4-.9-1.9-.6-.4-1.5-.6-2.8-.6H920v5.5h3.4c1.4.1 2.4-.2 3-.7z"
                  class="st0" />
                <path d="M49 82v115.3H3V5h46.3l70.5 113.4V5h46v192.3h-45L49 82zM314.5 186.9c-12.6 9.7-30.2 14.5-53 14.5-27.1 0-47.1-7-60-21.1-12.9-14-19.4-33-19.4-57v-4.6c0-8.4.8-16.2 2.4-23.3 1.6-7.2 4.1-13.7 7.5-19.6 6.6-12 16-21.2 28-27.6 12-6.4 26.1-9.6 42.3-9.6 9.2 0 17.5.9 25 2.7 7.5 1.8 14.2 4.5 19.9 8 11.5 7.2 20 16.6 25.5 28.3s8.2 24.6 8.2 38.7v17.4H230.8c1.3 9.7 4.5 16.9 9.8 21.7 5.3 4.8 12.7 7.2 22.2 7.2 6.8 0 12.2-1.3 16.3-4 4-2.7 7-6.3 8.8-10.7h52c-4.4 16.3-12.9 29.3-25.4 39zM241.3 82.4c-5.4 4.6-8.9 11.5-10.5 20.8h61.7c-1.1-8.8-4-15.6-8.7-20.4-4.8-4.8-11.7-7.2-20.9-7.2-9.1 0-16.3 2.2-21.6 6.8z"
                  class="st0" />
                <path d="M415.2 153.3l-28.5 44H329l57.6-81-52.2-74.6h55.5l25.6 39.4L441 41.8h55.2l-52 74 55.5 81.5h-56l-28.5-44z"
                  class="st0" />
              </svg>
            </div>
            <h3 class="carousel--slogan">Inspire and you’ll be<br>next in line to be inspired</h3>
          </div>
        </article>

      </div>

    </header>

    <main class="page-content" role="main">
      <div class="content">
        <nav class="menu menu-light">
          <?php include 'menu.php';?>

        </nav>

        <div class="logo-main medium-offset-1 columns">
          <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" viewBox="0 0 150 40">
            <style>
              .svg-logo {
                fill: #50193a
              }
            </style>
            <path d="M9.9 16.2v22.3H1V1.3h8.9l13.6 22v-22h8.9v37.2h-8.7L9.9 16.2zM61.1 36.5c-2.4 1.9-5.8 2.8-10.2 2.8-5.2 0-9.1-1.4-11.6-4.1-2.5-2.7-3.7-6.4-3.7-11v-.9c0-1.6.2-3.1.5-4.5s.8-2.7 1.5-3.8c1.3-2.3 3.1-4.1 5.4-5.4 2.3-1.2 5-1.9 8.2-1.9 1.8 0 3.4.2 4.8.5 1.5.3 2.7.9 3.8 1.6 2.2 1.4 3.9 3.2 4.9 5.5 1.1 2.3 1.6 4.8 1.6 7.5v3.4H44.9c.2 1.9.9 3.3 1.9 4.2 1 .9 2.5 1.4 4.3 1.4 1.3 0 2.4-.3 3.1-.8.8-.5 1.3-1.2 1.7-2.1h10c-.8 3.2-2.4 5.7-4.8 7.6zM47 16.3c-1 .9-1.7 2.2-2 4h11.9c-.2-1.7-.8-3-1.7-3.9-.9-.9-2.3-1.4-4-1.4-1.8-.1-3.2.4-4.2 1.3z"
              class="svg-logo" />
            <path d="M80.5 30L75 38.5H63.9L75 22.8 64.9 8.4h10.7l4.9 7.6 4.9-7.6H96L86 22.7l10.7 15.8H86L80.5 30zM141.7 38.5H137c-1.5 0-2.9-.1-4-.3-1.2-.2-2.2-.5-3-.9-1.6-.8-2.8-2.2-3.4-4-.6-1.9-.9-4.3-.9-7.5v-9.6h-5.1V8.4c.6 0 1.1 0 1.5-.1.4-.1.9-.1 1.4-.2 1-.1 1.7-.5 2.1-1 .4-.5.7-1.4.9-2.7.1-.6.1-1.3.2-2.1.1-.7.1-1 .1-1.6h7.8v7.1h7.2v8.4h-7.2V24c0 .9 0 1.6.1 2.3.1.6.2 1.2.3 1.6.3.8.8 1.3 1.5 1.6.7.2 1.9.4 3.4.4h1.9v8.6zM143.7 5.8c-.6-.5-.9-1.2-.9-2.2v-.2c0-.3 0-.6.1-.9s.2-.5.3-.7c.3-.5.6-.8 1.1-1.1.5-.3 1-.4 1.6-.4.3 0 .6 0 .8.1.3.1.5.1.7.3.5.2.8.6 1.1 1.1.3.5.4 1 .4 1.6v.2c0 .3 0 .6-.1.9-.1.3-.2.5-.3.7-.3.4-.6.8-1.1 1-.5.2-1 .3-1.5.3-.8 0-1.6-.2-2.2-.7zm4-.4c.5-.4.7-1 .7-1.9v-.1c0-.8-.2-1.4-.7-1.9-.5-.4-1.1-.7-1.8-.7s-1.3.2-1.8.7c-.5.5-.7 1.1-.7 1.9v.1c0 .8.2 1.4.7 1.9.5.4 1.1.6 1.8.6.8 0 1.4-.2 1.8-.6zm-2.4-1.6V5h-.5V1.8h1.3c.4 0 .8.1.9.3.2.2.3.4.3.7 0 .2-.1.4-.2.5-.1.1-.3.2-.5.3.2 0 .3.1.4.2.1.1.1.3.1.5V5h-.6v-.1-.5c0-.2 0-.3-.1-.4-.1-.1-.3-.1-.5-.1h-.6zm1.3-.6c.1-.1.2-.2.2-.4s-.1-.3-.2-.4c-.1-.1-.3-.1-.5-.1h-.7v1.1h.7c.2 0 .4-.1.5-.2z"
              class="svg-logo" />
          </svg>
        </div>


        <!-- SERVICE  -->
        <article class="service" id="ser-next">

          <div class="row expanded">
            <div class="xxlarge-10 xxlarge-offset-2 xlarge-10 xlarge-offset-2 medium-10 medium-offset-1 xsmall-10 xsmall-offset-1 columns">
              <h3 class="service--title">
                Ser Nex😍t<sup>&copy;</sup> é ser maleável.
                Acreditamos que a fluidez
                guia o conhecimento até
                à inovação.
              </h3>
            </div>
          </div>
          <div class="row expanded">
            <div class="xxlarge-4 xxlarge-offset-2 xlarge-4 xlarge-offset-2 medium-5 medium-offset-1 xsmall-10 xsmall-offset-1 columns">
              <div class="service--box consultoria">
                <h4 class="box--title">
                  Consultoria <br>
                  Especializada
                </h4>
              </div>
              <div class="service--box projectos">
                <h4 class="box--title">
                  Projetos
                </h4>
              </div>
            </div>
            <div class="xxlarge-4 xxlarge-offset-0 xlarge-4 xlarge-offset-0 medium-5 medium-offset-0 xsmall-10 xsmall-offset-1 columns">
              <p class="service--subtitle">
                Somos uma consultora 100% portuguesa tecnológica, mas o que nos define é a curiosidade.
                Vemos a atualidade como passado e o não conformismo como uma meta diária.
              </p>
              <div class="service--box nearshore">
                <h4 class="box--title">
                  Nearshore
                </h4>
              </div>
              <p class="service--note">
                Somos pragmáticos e estratégicos em função de um objectivo: conseguir sempre os melhores projectos para
                os
                nossos Colaboradores.  
              </p>
            </div>
          </div>

        </article>

        <!-- MANIFESTO  -->
        <div class="manifesto-wrapper" id="manifesto">
          <article class="manifesto">
            <nav class="menu menu-full manif">
              <?php include 'menu.php';?>
            </nav>

            <div class="logo-main medium-offset-1 columns">
              <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" viewBox="0 0 150 40">
                <style>
                  .svg-logo2 {
                    fill: #fff
                  }
                </style>
                <path d="M9.9 16.2v22.3H1V1.3h8.9l13.6 22v-22h8.9v37.2h-8.7L9.9 16.2zM61.1 36.5c-2.4 1.9-5.8 2.8-10.2 2.8-5.2 0-9.1-1.4-11.6-4.1-2.5-2.7-3.7-6.4-3.7-11v-.9c0-1.6.2-3.1.5-4.5s.8-2.7 1.5-3.8c1.3-2.3 3.1-4.1 5.4-5.4 2.3-1.2 5-1.9 8.2-1.9 1.8 0 3.4.2 4.8.5 1.5.3 2.7.9 3.8 1.6 2.2 1.4 3.9 3.2 4.9 5.5 1.1 2.3 1.6 4.8 1.6 7.5v3.4H44.9c.2 1.9.9 3.3 1.9 4.2 1 .9 2.5 1.4 4.3 1.4 1.3 0 2.4-.3 3.1-.8.8-.5 1.3-1.2 1.7-2.1h10c-.8 3.2-2.4 5.7-4.8 7.6zM47 16.3c-1 .9-1.7 2.2-2 4h11.9c-.2-1.7-.8-3-1.7-3.9-.9-.9-2.3-1.4-4-1.4-1.8-.1-3.2.4-4.2 1.3z"
                  class="svg-logo2" />
                <path d="M80.5 30L75 38.5H63.9L75 22.8 64.9 8.4h10.7l4.9 7.6 4.9-7.6H96L86 22.7l10.7 15.8H86L80.5 30zM141.7 38.5H137c-1.5 0-2.9-.1-4-.3-1.2-.2-2.2-.5-3-.9-1.6-.8-2.8-2.2-3.4-4-.6-1.9-.9-4.3-.9-7.5v-9.6h-5.1V8.4c.6 0 1.1 0 1.5-.1.4-.1.9-.1 1.4-.2 1-.1 1.7-.5 2.1-1 .4-.5.7-1.4.9-2.7.1-.6.1-1.3.2-2.1.1-.7.1-1 .1-1.6h7.8v7.1h7.2v8.4h-7.2V24c0 .9 0 1.6.1 2.3.1.6.2 1.2.3 1.6.3.8.8 1.3 1.5 1.6.7.2 1.9.4 3.4.4h1.9v8.6zM143.7 5.8c-.6-.5-.9-1.2-.9-2.2v-.2c0-.3 0-.6.1-.9s.2-.5.3-.7c.3-.5.6-.8 1.1-1.1.5-.3 1-.4 1.6-.4.3 0 .6 0 .8.1.3.1.5.1.7.3.5.2.8.6 1.1 1.1.3.5.4 1 .4 1.6v.2c0 .3 0 .6-.1.9-.1.3-.2.5-.3.7-.3.4-.6.8-1.1 1-.5.2-1 .3-1.5.3-.8 0-1.6-.2-2.2-.7zm4-.4c.5-.4.7-1 .7-1.9v-.1c0-.8-.2-1.4-.7-1.9-.5-.4-1.1-.7-1.8-.7s-1.3.2-1.8.7c-.5.5-.7 1.1-.7 1.9v.1c0 .8.2 1.4.7 1.9.5.4 1.1.6 1.8.6.8 0 1.4-.2 1.8-.6zm-2.4-1.6V5h-.5V1.8h1.3c.4 0 .8.1.9.3.2.2.3.4.3.7 0 .2-.1.4-.2.5-.1.1-.3.2-.5.3.2 0 .3.1.4.2.1.1.1.3.1.5V5h-.6v-.1-.5c0-.2 0-.3-.1-.4-.1-.1-.3-.1-.5-.1h-.6zm1.3-.6c.1-.1.2-.2.2-.4s-.1-.3-.2-.4c-.1-.1-.3-.1-.5-.1h-.7v1.1h.7c.2 0 .4-.1.5-.2z"
                  class="svg-logo2" />
              </svg>
            </div>


            <div class="row expanded">
              <div class="xxlarge-7 xxlarge-offset-2 xlarge-5 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-1 columns">
                <h3 class="manifesto--title">
                  Your Nex t<sup>&copy;</sup> <span>Manifesto</span>.
                </h3>
              </div>
            </div>
            <div class="row expanded">
              <div class="xxlarge-8 xxlarge-offset-2 xlarge-10 xlarge-offset-2 medium-8 medium-offset-1 xsmall-6 xsmall-offset-1 columns">
                <div class="manifesto--details">
                  <p class="manifesto--text">
                    <span><sup>1</sup>Prospera</span>
                    O crescimento está sempre ao teu alcance.
                    Ao partilhar, criamos espaço para novas ideias.
                    Celebra o sucesso com todos.
                  </p>
                  <div class="menifesto--img">
                    <img src="/public/imgs/prospera@2x.png" alt="">
                  </div>

                </div>
              </div>
            </div>
          </article>
        </div>
        <!--  SECTORS: Info Tech -->


        <div class="sectors-tang">
          <div class="info-wrapper">
            <article class="sectors info-tech" id="areas">
              <nav class="menu menu-light">
                <?php include 'menu.php';?>
              </nav>
              <div class="row expanded">
                <div class="xxlarge-6 xxlarge-offset-2 xlarge-6 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-1 columns">
                  <h3 class="sectors-title">
                    The Nex t<sup>&copy;</sup>
                    <span>Information
                      Technology</span>.
                  </h3>
                </div>
              </div>
              <div class="row expanded">
                <div class="xxlarge-8 xxlarge-offset-2 xlarge-8 xlarge-offset-2 medium-10 medium-offset-1 xsmall-10 xsmall-offset-1">
                  <div class="row expanded">
                    <div class="xxlarge-3 xlarge-3 medium-3 xsmall-10 columns">
                      <div class="sectors-box">
                        <h5 class="sectors-box--title">
                          Desenvolvimento
                        </h5>
                        <ul class="sectors-box--list">
                          <li>Microsoft</li>
                          <li>Oracle</li>
                          <li>Opensource</li>
                          <li>SAP</li>
                          <li>Outsystems</li>
                        </ul>
                      </div>
                      <div class="sectors-box">
                        <h5 class="sectors-box--title">
                          Middleware
                        </h5>
                        <ul class="sectors-box--list">
                          <li>IBM Websphere</li>
                          <li>Jboss</li>
                          <li>SAP</li>
                          <li>TIBCO</li>
                        </ul>
                      </div>
                    </div>
                    <div class="xxlarge-3 xxlarge-offset-1 xlarge-3 xlarge-offset-1 medium-3 medium-offset-1 xsmall-10 xsmall-offset-0 columns">
                      <div class="sectors-box">
                        <h5 class="sectors-box--title">
                          Infraestruturas
                        </h5>
                        <ul class="sectors-box--list">
                          <li>Networking</li>
                          <li>Security</li>
                          <li>System Administration</li>
                          <li>Cloud</li>
                          <li>Virtualization</li>
                        </ul>
                      </div>
                      <div class="sectors-box two-line">
                        <h5 class="sectors-box--title">
                          QA/Testes
                        </h5>
                        <ul class="sectors-box--list">
                          <li>Selenium</li>
                          <li>​​Visual Studio</li>
                          <li>​​Cucumber</li>
                          <li>​​Appium</li>
                          <li>​​HP Quality Center</li>
                          <li>​​Jira</li>
                          <li>Testlink</li>
                          <li>Squashtest</li>
                          <li>​​Robotframework</li>
                        </ul>
                      </div>
                    </div>
                    <div class="xxlarge-3 xxlarge-offset-1 xlarge-3 xlarge-offset-1 medium-3 medium-offset-1 xsmall-10 xsmall-offset-0 columns">
                      <div class="sectors-box top-offset">
                        <h5 class="sectors-box--title">
                          Business <br>
                          Intelligence
                        </h5>
                        <ul class="sectors-box--list">
                          <li>Microsoft</li>
                          <li>Oracle</li>
                          <li>IBM</li>
                          <li>SAP</li>
                          <li>Sybase</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </article>
          </div>

          <!--  SECTORS: Big Data -->
          <div class="big-data-wrapper">


            <article class="sectors big-data">
              <nav class="menu menu-light">
                <?php include 'menu.php';?>
              </nav>
              <div class="row expanded">
                <div class="xxlarge-6 xxlarge-offset-2 xlarge-5 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-1 columns">
                  <h3 class="sectors-title">
                    The Nex t<sup>&copy;</sup>
                    <span>Big Data</span>.
                  </h3>
                </div>
              </div>
              <div class="row expanded">
                <div class="xxlarge-8 xxlarge-offset-2 xlarge-8 xlarge-offset-2 medium-10 medium-offset-1 xsmall-10 xsmall-offset-1">
                  <div class="row expanded">
                    <div class="xxlarge-3 xlarge-3 medium-3 xsmall-10 columns">
                      <div class="sectors-box">
                        <h5 class="sectors-box--title">
                          Marketing
                          Digital
                        </h5>
                        <ul class="sectors-box--list">
                          <li> SEO/SEM</li>
                          <li>CRM</li>
                          <li>Content Marketing</li>
                          <li>E-commerce</li>
                          <li>Web App</li>
                        </ul>
                      </div>
                    </div>
                    <div class="xxlarge-3 xxlarge-offset-1 xlarge-3 xlarge-offset-1 medium-3 medium-offset-1 xsmall-10 xsmall-offset-0 columns">
                      <div class="sectors-box">
                        <h5 class="sectors-box--title">
                          Data Science/
                          Data Mining
                        </h5>
                        <ul class="sectors-box--list">
                          <li>Machine Learning</li>
                          <li>NLP</li>
                          <li>Hadoop, Spark, Cloudera</li>
                          <li>R, Python.</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </article>
          </div>
          <div class="rpa-wrapper">

            <!--  SECTORS: RPA -->
            <article class="sectors rpa">
              <nav class="menu menu-light">
                <?php include 'menu.php';?>
              </nav>
              <div class="row expanded">
                <div class="xxlarge-6 xxlarge-offset-2 xlarge-6 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-1">
                  <h3 class="sectors-title">
                    The Nex t<sup>&copy;</sup>
                    <span>RPA</span>*
                  </h3>
                </div>
              </div>
              <div class="row expanded">
                <div class="xxlarge-8 xxlarge-offset-2 xlarge-8 xlarge-offset-2 medium-10 medium-offset-1 xsmall-10 xsmall-offset-1">
                  <div class="row expanded">
                    <div class="sectors-box">
                      <h5 class="sectors-box--title">
                        Blue Prism<br>
                        UiPath<br>
                        Automation Anywhere
                      </h5>
                      <p class="note">
                        <strong>* Robotic Process Automation </strong> é uma tecnologia disruptiva que permite realizar
                        atividades rotineiras,
                        normalmente executadas manualmente, de uma forma automática, tornando as operações mais
                        eficazes
                        e
                        mais
                        ágeis nos seus processos de negócio.
                      </p>
                    </div>

                  </div>
                </div>
              </div>
            </article>

          </div>

        </div>
        <div class="setores-wrapper">


          <!--  SECTORS: ATIVIDADE -->
          <article class="sectors setores" id="setores">
            <nav class="menu menu-light">
              <?php include 'menu.php';?>
            </nav>

            <div class="row expanded">
              <div class="xxlarge-5 xxlarge-offset-2 xlarge-5 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-1 columns">
                <h3 class="sectors-title">
                  Nex t<sup>&copy;</sup>
                  <span>Sectors</span>
                </h3>
              </div>
            </div>
            <div class="row expanded">
              <div class="xxlarge-8 xxlarge-offset-2 xlarge-8 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-0">
                <div class="row expanded">
                  <div class="xxlarge-3 xsmall-5 xsmall-offset-1 columns">
                    <div class="sectors-icons">
                      <img src="public/imgs/pictograms/financeiro.svg" alt="">
                      <p>Financeiro</p>
                    </div>
                  </div>
                  <div class="xxlarge-3 xsmall-5 xsmall-offset-1 columns">
                    <div class="sectors-icons">
                      <img src="public/imgs/pictograms/telecomunicacoes.svg" alt="">
                      <p>Telecomunicações</p>
                    </div>
                  </div>
                  <div class="xxlarge-3 xsmall-5 xsmall-offset-1 columns">
                    <div class="sectors-icons">
                      <img src="public/imgs/pictograms/retalho.svg" alt="">
                      <p>Retalho</p>
                    </div>
                  </div>
                  <div class="xxlarge-3 xsmall-5 xsmall-offset-1 columns">
                    <div class="sectors-icons">
                      <img src="public/imgs/pictograms/saude.svg" alt="">
                      <p>Saúde</p>
                    </div>
                  </div>
                  <div class="xxlarge-3 xsmall-5 xsmall-offset-1 columns">
                    <div class="sectors-icons">
                      <img src="public/imgs/pictograms/publico.svg" alt="">
                      <p>Sector Público</p>
                    </div>
                  </div>
                  <div class="xxlarge-3 xsmall-5 xsmall-offset-1 columns">
                    <div class="sectors-icons">
                      <img src="public/imgs/pictograms/servicos.svg" alt="">
                      <p>Serviços</p>
                    </div>
                  </div>
                  <div class="xxlarge-3 xsmall-5 xsmall-offset-1 columns">
                    <div class="sectors-icons">
                      <img src="public/imgs/pictograms/industria.svg" alt="">
                      <p>Indústria</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>

          </article>

        </div>
        <!-- ============= FOOTER ============= -->
        <article class="main-footer" id="contactos">
          <div class="xxlarge-10 xxlarge-offset-2 medium-offset-1 columns">
            <h4 class="footer-slogan">
              Shaping the <span class="word-next">Nex<img src="public/imgs/robot@2x.png" alt=""> <span class="word-t">t</span></span><span
                class="word-future">Future.</span>
            </h4>
            <address>
              <p>
                Avenida 5 de Outubro, nº 125, 4º <br>
                1050-052 Lisboa
              </p>
            </address>
            <div class="contact">
              <a href="mailto:your@nextengineering.com">your@nextengineering.com</a>
              <p></p>
              <a href="tel:351213749294">+351.213.749.294</a>
            </div>
            <div class="social">
              <ul>
                <li><a href="">twitter</a></li>
                <li><a href="">linkedin</a></li>
                <li><a href="">instagram</a></li>
                <li><a href="">facebook</a></li>
              </ul>
            </div>
          </div>
        </article>

      </div>

    </main>
  </div>




</div>

<div class="page-main page-next" aria-hidden="true"></div>
<div class="page-main page-prev" aria-hidden="true"></div>