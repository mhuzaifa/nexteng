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
    <nav class="menu">
      <?php include 'menu.php';?>
    </nav>
    
    <header class="page-header header-purple" id="intro" data-jq-clipthru="nav-full-top">
      <article class="carousel-wrapper">
        <div class="carousel-content inspire">
          <picture class="carousel--img">
            <source srcset="/public/imgs/inspire.jpg 1x, /public/imgs/inspire@2x.jpg 2x"><img src="/public/imgs/inspire.jpg"
              alt=""></picture>
          <div class="logo-container">
            <svg id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 471.4 101.3" xml:space="preserve">
              <style type="text/css">
                .st0,
                .st1 {
                  fill: #fff
                }
              </style>
              <g>
                <g>
                  <path d="M532.4 99.3H520c-4 0-7.5-.3-10.5-.8s-5.6-1.3-7.8-2.3c-4.2-2.2-7.2-5.6-8.8-10.5-1.6-4.8-2.4-11.3-2.4-19.4V41.5h-13.3V21.1c1.5 0 2.9-.1 4-.2s2.4-.3 3.7-.6c2.5-.4 4.4-1.2 5.5-2.5s1.9-3.6 2.2-7c.2-1.6.3-3.4.5-5.3.1-1.9.2-2.5.3-4.1h20.3v18.4h18.7v21.7h-18.7v20c0 2.3.1 4.2.3 5.9.2 1.7.4 3 .7 4.1.7 2.1 2.1 3.4 4 4 1.9.6 4.9.9 8.7.9h5v22.9z"
                    class="st1" />
                </g>
                <g>
                  <path d="M537.7 14.1c-1.5-1.3-2.3-3.2-2.3-5.8V8c0-.8.1-1.6.3-2.3s.4-1.4.8-1.9c.7-1.2 1.6-2.1 2.8-2.8s2.6-1 4.1-1c.8 0 1.5.1 2.1.2.7.1 1.3.4 1.9.7 1.2.6 2.2 1.5 2.9 2.7s1.1 2.6 1.1 4.3v.4c0 .8-.1 1.6-.3 2.3-.2.7-.5 1.3-.8 1.9-.7 1.2-1.6 2.1-2.8 2.6-1.2.6-2.5.9-4 .9-2.4.1-4.3-.6-5.8-1.9zm10.4-1c1.2-1.1 1.8-2.7 1.8-4.8V8c0-2.1-.6-3.8-1.9-4.9-1.2-1.2-2.8-1.7-4.7-1.7-1.9 0-3.4.6-4.7 1.8-1.2 1.2-1.8 2.8-1.8 4.9v.2c0 2.1.6 3.7 1.8 4.8 1.2 1.1 2.8 1.7 4.7 1.7 2 0 3.6-.6 4.8-1.7zM541.8 9v3.1h-1.4V3.8h3.3c1.2 0 2 .2 2.5.7.5.4.7 1 .7 1.7 0 .6-.1 1.1-.4 1.4s-.7.6-1.3.7c.5.1.9.3 1.1.6.2.3.3.8.3 1.4v1.4c0 .1.1.1.1.2h-1.5s0-.1-.1-.1v-1.5c0-.5-.1-.9-.3-1.1-.2-.2-.7-.3-1.4-.3h-1.6V9zm3.2-1.6c.3-.3.4-.6.4-1.1 0-.4-.1-.7-.5-.9-.3-.2-.8-.3-1.4-.3h-1.8v2.8h1.7c.8-.1 1.4-.2 1.6-.5z"
                    class="st1" />
                </g>
                <g>
                  <path d="M23.2 41.2v58.1H0V2.4h23.3l35.5 57.1V2.4H82v96.8H59.4l-36.2-58z" class="st0" />
                </g>
                <g>
                  <path d="M156.9 94c-6.3 4.9-15.2 7.3-26.7 7.3-13.6 0-23.7-3.5-30.2-10.6S90.2 74.1 90.2 62v-2.3c0-4.2.4-8.1 1.2-11.7.8-3.6 2.1-6.9 3.8-9.9 3.3-6 8-10.7 14.1-13.9s13.1-4.9 21.3-4.9c4.6 0 8.8.4 12.6 1.4 3.8.9 7.1 2.3 10 4 5.8 3.6 10.1 8.4 12.8 14.3 2.8 5.9 4.1 12.4 4.1 19.5v8.8h-55.5c.6 4.9 2.3 8.5 4.9 10.9 2.7 2.4 6.4 3.6 11.2 3.6 3.4 0 6.2-.7 8.2-2 2-1.4 3.5-3.2 4.4-5.4h26.2c-2.1 8.2-6.3 14.7-12.6 19.6zM120 41.4c-2.7 2.3-4.5 5.8-5.3 10.5h31c-.5-4.4-2-7.8-4.4-10.3-2.4-2.4-5.9-3.6-10.5-3.6-4.5-.1-8.1 1.1-10.8 3.4z"
                    class="st0" />
                </g>
                <g>
                  <path d="M207.6 77.1l-14.4 22.2h-29l29-40.8-26.3-37.6h27.9l12.9 19.9 12.9-19.9h27.8l-26.2 37.3 27.9 41.1h-28.2l-14.3-22.2z"
                    class="st0" />
                </g>
              </g>
            </svg>
          </div>
          <h3 class="carousel--slogan">Inspire and you’ll be<br>next in line to be inspired</h3>
        </div>
      </article>
    </header>
    <h1 data-target="#intro" class="logo-main"> Next
            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" viewBox="0 0 150 40">
              <path d="M9.9 16.2v22.3H1V1.3h8.9l13.6 22v-22h8.9v37.2h-8.7L9.9 16.2zM61.1 36.5c-2.4 1.9-5.8 2.8-10.2 2.8-5.2 0-9.1-1.4-11.6-4.1-2.5-2.7-3.7-6.4-3.7-11v-.9c0-1.6.2-3.1.5-4.5s.8-2.7 1.5-3.8c1.3-2.3 3.1-4.1 5.4-5.4 2.3-1.2 5-1.9 8.2-1.9 1.8 0 3.4.2 4.8.5 1.5.3 2.7.9 3.8 1.6 2.2 1.4 3.9 3.2 4.9 5.5 1.1 2.3 1.6 4.8 1.6 7.5v3.4H44.9c.2 1.9.9 3.3 1.9 4.2 1 .9 2.5 1.4 4.3 1.4 1.3 0 2.4-.3 3.1-.8.8-.5 1.3-1.2 1.7-2.1h10c-.8 3.2-2.4 5.7-4.8 7.6zM47 16.3c-1 .9-1.7 2.2-2 4h11.9c-.2-1.7-.8-3-1.7-3.9-.9-.9-2.3-1.4-4-1.4-1.8-.1-3.2.4-4.2 1.3z"
                class="svg-logo" />
              <path d="M80.5 30L75 38.5H63.9L75 22.8 64.9 8.4h10.7l4.9 7.6 4.9-7.6H96L86 22.7l10.7 15.8H86L80.5 30zM141.7 38.5H137c-1.5 0-2.9-.1-4-.3-1.2-.2-2.2-.5-3-.9-1.6-.8-2.8-2.2-3.4-4-.6-1.9-.9-4.3-.9-7.5v-9.6h-5.1V8.4c.6 0 1.1 0 1.5-.1.4-.1.9-.1 1.4-.2 1-.1 1.7-.5 2.1-1 .4-.5.7-1.4.9-2.7.1-.6.1-1.3.2-2.1.1-.7.1-1 .1-1.6h7.8v7.1h7.2v8.4h-7.2V24c0 .9 0 1.6.1 2.3.1.6.2 1.2.3 1.6.3.8.8 1.3 1.5 1.6.7.2 1.9.4 3.4.4h1.9v8.6zM143.7 5.8c-.6-.5-.9-1.2-.9-2.2v-.2c0-.3 0-.6.1-.9s.2-.5.3-.7c.3-.5.6-.8 1.1-1.1.5-.3 1-.4 1.6-.4.3 0 .6 0 .8.1.3.1.5.1.7.3.5.2.8.6 1.1 1.1.3.5.4 1 .4 1.6v.2c0 .3 0 .6-.1.9-.1.3-.2.5-.3.7-.3.4-.6.8-1.1 1-.5.2-1 .3-1.5.3-.8 0-1.6-.2-2.2-.7zm4-.4c.5-.4.7-1 .7-1.9v-.1c0-.8-.2-1.4-.7-1.9-.5-.4-1.1-.7-1.8-.7s-1.3.2-1.8.7c-.5.5-.7 1.1-.7 1.9v.1c0 .8.2 1.4.7 1.9.5.4 1.1.6 1.8.6.8 0 1.4-.2 1.8-.6zm-2.4-1.6V5h-.5V1.8h1.3c.4 0 .8.1.9.3.2.2.3.4.3.7 0 .2-.1.4-.2.5-.1.1-.3.2-.5.3.2 0 .3.1.4.2.1.1.1.3.1.5V5h-.6v-.1-.5c0-.2 0-.3-.1-.4-.1-.1-.3-.1-.5-.1h-.6zm1.3-.6c.1-.1.2-.2.2-.4s-.1-.3-.2-.4c-.1-.1-.3-.1-.5-.1h-.7v1.1h.7c.2 0 .4-.1.5-.2z"
                class="svg-logo" />
            </svg>
      </h1>
    <main class="page-content" role="main">
      <div class="content">

        <!-- SERVICE  -->
        <article class="service" id="ser-next" data-jq-clipthru="nav-bg-white light">
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
        <article class="manifesto" id="manifesto" data-jq-clipthru="nav-bg-purple light ">

          <div class="row expanded">
            <div class="xxlarge-7 xxlarge-offset-2 xlarge-6 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-1 columns">
              <h3 class="manifesto--title">
                Your Nex t<sup>&copy;</sup><br> <span>Manifesto<span class="text-white">.</span></span>
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
                  <picture>
                    <source srcset="/public/imgs/prospera.png 1x, /public/imgs/prospera@2x.png 2x"><img src="/public/imgs/prospera.png"
                      alt=""></picture>
                </div>

              </div>
            </div>
          </div>
        </article>

        <!--  SECTORS: Info Tech -->
        <div data-jq-clipthru="nav-bg-tang light" id="areas">
          <div class="sticky-container">
            <article style="padding:0" class="sectors"></article>
            <article class="sectors info-tech" id="infoTech">
              <div class="active-overlay">
              </div>

              <div class="row expanded">
                <div class="xxlarge-6 xxlarge-offset-2 xlarge-6 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-1 columns">
                  <h3 class="sectors-title">
                    The Nex t<sup>&copy;</sup> <br>
                    <span>Information
                      Technology<span class="text-white">.</span></span>
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

            <!--  SECTORS: Big Data -->

            <article class="sectors big-data" data-jq-clipthru="">

              <div class="active-overlay">
              </div>

              <div class="row expanded">
                <div class="xxlarge-6 xxlarge-offset-2 xlarge-6 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-1 columns">
                  <h3 class="sectors-title">
                    The Nex t<sup>&copy;</sup> <br>
                    <span>Big Data<span class="text-white">.</span></span>
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

            <!--  SECTORS: RPA -->
            <article class="sectors rpa sticky"  data-jq-clipthru="">
            <div class="active-overlay">
              </div>

              <div class="row expanded">
                <div class="xxlarge-5 xxlarge-offset-2 xlarge-6 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-1">
                  <h3 class="sectors-title">
                    The Nex t<sup>&copy;</sup> <br>
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
            <!--  SECTORS: ATIVIDADE -->
            <article class="sectors setores" id="setores" data-jq-clipthru="nav-bg-tang-lighter light">


              <div class="row expanded">
                <div class="xxlarge-5 xxlarge-offset-2 xlarge-5 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-1 columns">
                  <h3 class="sectors-title">
                    Nex t<sup>&copy;</sup> <br>
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
        <article class="main-footer" id="contactos" data-jq-clipthru="nav-bg-white light">
          <div class="xxlarge-10 xxlarge-offset-2 medium-offset-1 columns">
            <h4 class="footer-slogan">
              Shaping the <span class="word-next">Nex<picture><source srcset="/public/imgs/robot.png 1x, /public/imgs/robot@2x.png 2x"><img src="/public/imgs/robot.png"
                    alt=""></picture><span class="word-t">t</span></span><span class="word-future">Future.</span>
            </h4>
            <address>
              <p>
                Avenida 5 de Outubro, nº 125, 4º <br>
                1050-052 Lisboa
              </p>
            </address>
            <div class="contact">
              <a href="mailto:your@nextengineering.com">your@nextengineering.com</a>
              <a href="tel:351213749294">+351.213.749.294</a>
            </div>
            <div class="social">
              <ul>
                <!-- <li><a href="">twitter</a></li> -->
                <li><a target="_blank" href="https://www.linkedin.com/company/nxt-engineering/">linkedin</a></li><!-- 
                <li><a href="">instagram</a></li>
                <li><a href="">facebook</a></li> -->
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