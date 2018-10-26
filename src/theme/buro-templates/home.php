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
                Ser Nex t<sup>&copy;</sup> é ser maleável.
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
            <div class="xxlarge-7 xxlarge-offset-2 xlarge-7 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-1 columns">
              <h3 class="manifesto--title">
                Your Nex t<sup>&copy;</sup><br> <span>Manifesto<span class="text-white">.</span></span>
              </h3>
              <div class="spacer"></div>
            </div>
          </div>
          <div class="row expanded">
            <div class="xxlarge-8 xxlarge-offset-2 xlarge-8 xlarge-offset-2 medium-10 medium-offset-1 xsmall-10 xsmall-offset-1 columns">

                      <div class="manifesto--details">
                        <div class="row expanded">
                          <div class="xxlarge-7 medium-7 xsmall-8 columns">
                            <p class="manifesto--text">
                              <span><sup>1</sup>Prospera</span>
                              O crescimento está sempre ao teu alcance.
                              Ao partilhar, criamos espaço para novas ideias.
                              Celebra o sucesso com todos.
                            </p>
                          </div>
                          <div class="xxlarge-4 xxlarge-offset-1 medium-4 medium-offset-1 xsmall-4 xsmall-offset-0 columns">
                            <div class="menifesto--img">
                              <picture>
                                <source srcset="/public/imgs/prospera.png 1x, /public/imgs/prospera@2x.png 2x"><img src="/public/imgs/prospera.png"
                                  alt=""></picture>
                            </div>
                          </div>
                        </div>
                      </div> 

                      <div class="manifesto--details">
                        <div class="row expanded">
                          <div class="xxlarge-7 medium-7 xsmall-8 columns">
                            <p class="manifesto--text">
                              <span><sup>2</sup>Curiosidade</span>
                              Recorre ao inesperado. Intriga-te tanto pela tecnologia como pela história da pessoa à tua frente.
                            </p>
                          </div>
                          <div class="xxlarge-4 xxlarge-offset-1 medium-4 medium-offset-1 xsmall-4 xsmall-offset-0 columns">
                            <div class="menifesto--img">
                           
                            </div>
                          </div>
                        </div>

                    </div> 

                      <div class="manifesto--details">
                        <div class="row expanded">
                          <div class="xxlarge-7 medium-7 xsmall-8 columns">
                            <p class="manifesto--text">
                              <span><sup>3</sup>Altruísmo</span>
                              Coloca-te no lugar do outro. Aceita a diversidade de expectativas. Ao ouvir, pensamos; ao reflectir, propomos.
                            </p>
                          </div>
                          <div class="xxlarge-4 xxlarge-offset-1 medium-4 medium-offset-1 xsmall-4 xsmall-offset-0 columns">
                            <div class="menifesto--img">
                           
                            </div>
                          </div>
                        </div>

                    </div>  

                      <div class="manifesto--details">
                        <div class="row expanded">
                          <div class="xxlarge-7 medium-7 xsmall-8 columns">
                            <p class="manifesto--text">
                              <span><sup>4</sup>Carácter</span>
                              Inspira-te a ti mesmo, inspira os outros.
                            </p>
                          </div>
                          <div class="xxlarge-4 xxlarge-offset-1 medium-4 medium-offset-1 xsmall-4 xsmall-offset-0 columns">
                            <div class="menifesto--img">
                           
                            </div>
                          </div>
                        </div>
                        </div>


                      <div class="manifesto--details">
                        <div class="row expanded">
                          <div class="xxlarge-7 medium-7 xsmall-8 columns">
                            <p class="manifesto--text">
                              <span><sup>5</sup>Plasticidade</span>
                              Aprende e melhora; adapta-te e chega onde não imaginavas.
                            </p>
                          </div>
                          <div class="xxlarge-4 xxlarge-offset-1 medium-4 medium-offset-1 xsmall-4 xsmall-offset-0 columns">
                            <div class="menifesto--img">
                           
                            </div>
                          </div>
                        </div>

                    
              <div class="scrollable-wrapper">

              </div>

<!-- onmouseover="document.body.style.overflow='hidden';" onmouseout="document.body.style.overflow='auto';" -->
              <div class="swiper-container" style="display:none">
                <div class="swiper-wrapper">
                  <div class="swiper-slide color-1">
                    <div class="manifesto--details">
                      <div class="row expanded">
                        <div class="xxlarge-7 medium-7 xsmall-8 columns">
                          <p class="manifesto--text">
                            <span><sup>1</sup>Prospera</span>
                            O crescimento está sempre ao teu alcance.
                            Ao partilhar, criamos espaço para novas ideias.
                            Celebra o sucesso com todos.
                          </p>
                        </div>
                        <div class="xxlarge-4 xxlarge-offset-1 medium-4 medium-offset-1 xsmall-4 xsmall-offset-0 columns">
                          <div class="menifesto--img">
                            <picture>
                              <source srcset="/public/imgs/prospera.png 1x, /public/imgs/prospera@2x.png 2x"><img src="/public/imgs/prospera.png"
                                alt=""></picture>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="swiper-slide color-2">
                    <div class="manifesto--details">
                      <div class="row expanded">
                        <div class="xxlarge-7 medium-7 xsmall-8 columns">
                          <p class="manifesto--text">
                            <span><sup>2</sup>Prospera</span>
                            O crescimento está sempre ao teu alcance.
                            Ao partilhar, criamos espaço para novas ideias.
                            Celebra o sucesso com todos.
                          </p>
                        </div>
                        <div class="xxlarge-4 xxlarge-offset-1 medium-4 medium-offset-1 xsmall-4 xsmall-offset-0 columns">
                          <div class="menifesto--img">
                            <picture>
                              <source srcset="/public/imgs/prospera.png 1x, /public/imgs/prospera@2x.png 2x"><img src="/public/imgs/prospera.png"
                                alt=""></picture>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="swiper-slide color-3">
                    <div class="manifesto--details">
                      <div class="row expanded">
                        <div class="xxlarge-7 medium-7 xsmall-8 columns">
                          <p class="manifesto--text">
                            <span><sup>3</sup>Prospera</span>
                            O crescimento está sempre ao teu alcance.
                            Ao partilhar, criamos espaço para novas ideias.
                            Celebra o sucesso com todos.
                          </p>
                        </div>
                        <div class="xxlarge-4 xxlarge-offset-1 medium-4 medium-offset-1 xsmall-4 xsmall-offset-0 columns">
                          <div class="menifesto--img">
                            <picture>
                              <source srcset="/public/imgs/prospera.png 1x, /public/imgs/prospera@2x.png 2x"><img src="/public/imgs/prospera.png"
                                alt=""></picture>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="swiper-slide color-4">
                    <div class="manifesto--details">
                      <div class="row expanded">
                        <div class="xxlarge-7 medium-7 xsmall-8 columns">
                          <p class="manifesto--text">
                            <span><sup>4</sup>Prospera</span>
                            O crescimento está sempre ao teu alcance.
                            Ao partilhar, criamos espaço para novas ideias.
                            Celebra o sucesso com todos.
                          </p>
                        </div>
                        <div class="xxlarge-4 xxlarge-offset-1 medium-4 medium-offset-1 xsmall-4 xsmall-offset-0 columns">
                          <div class="menifesto--img">
                            <picture>
                              <source srcset="/public/imgs/prospera.png 1x, /public/imgs/prospera@2x.png 2x"><img src="/public/imgs/prospera.png"
                                alt=""></picture>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="swiper-slide color-5">
                    <div class="manifesto--details">
                      <div class="row expanded">
                        <div class="xxlarge-7 medium-7 xsmall-8 columns">
                          <p class="manifesto--text">
                            <span><sup>5</sup>Prospera</span>
                            O crescimento está sempre ao teu alcance.
                            Ao partilhar, criamos espaço para novas ideias.
                            Celebra o sucesso com todos.
                          </p>
                        </div>
                        <div class="xxlarge-4 xxlarge-offset-1 medium-4 medium-offset-1 xsmall-4 xsmall-offset-0 columns">
                          <div class="menifesto--img">
                            <picture>
                              <source srcset="/public/imgs/prospera.png 1x, /public/imgs/prospera@2x.png 2x"><img src="/public/imgs/prospera.png"
                                alt=""></picture>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>


            </div>
          </div>
        </article>

        <!--  SECTORS: Info Tech -->
        <div data-jq-clipthru="nav-bg-tang light" id="areas">

          <div class="sticky-container nob">
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
                    <div class="xxlarge-3 xlarge-3 medium-3 xsmall-5 columns">
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
                    <div class="xxlarge-3 xxlarge-offset-1 xlarge-3 xlarge-offset-1 medium-3 medium-offset-1 xsmall-5 xsmall-offset-1 columns">
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
                    <div class="xxlarge-3 xxlarge-offset-1 xlarge-3 xlarge-offset-1 medium-3 medium-offset-1 xsmall-5 xsmall-offset-0 columns">
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
                    <div class="xxlarge-3 xlarge-3 medium-3 xsmall-5 columns">
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
                    <div class="xxlarge-3 xxlarge-offset-1 xlarge-3 xlarge-offset-1 medium-3 medium-offset-1 xsmall-5 xsmall-offset-1 columns">
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
            <article class="sectors rpa sticky" data-jq-clipthru="">
              <div class="active-overlay">
              </div>

              <div class="row expanded">
                <div class="xxlarge-6 xxlarge-offset-2 xlarge-6 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-1 columns">
                  <h3 class="sectors-title">
                    The Nex t<sup>&copy;</sup> <br>
                    <span>RPA</span>*
                  </h3>
                </div>
              </div>
              <div class="row expanded">
                <div class="xxlarge-8 xxlarge-offset-2 xlarge-8 xlarge-offset-2 medium-10 medium-offset-1 xsmall-10 xsmall-offset-1 columns">
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
                      <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" viewBox="0 0 142 113">
                        <style>
                          .ij0{fill:#ffca7c}.ij1{fill:#f5b454}.ij2{fill:#ec8b65}
                        </style>
                        <circle cx="91.2" cy="57.4" r="38.8" class="ij0"/>
                        <path d="M59.1 60.2c5.5-22.4 28.2-36 50.5-30.5 8.1 2 15.1 6.3 20.5 12-4.9-11.8-15.2-21.2-28.5-24.5-22.4-5.5-45 8.1-50.5 30.5-3.5 14.2.7 28.5 10 38.5-3.3-7.9-4.2-17-2-26z" class="ij1"/>
                        <path d="M81.7 98.7c-22.7-5.6-36.6-28.6-31-51.3s28.6-36.6 51.3-31 36.6 28.6 31 51.3c-5.6 22.7-28.6 36.6-51.3 31zm18.7-75.4c-18.9-4.7-38 6.9-42.7 25.8s6.9 38 25.8 42.7 38-6.9 42.7-25.8c4.6-18.8-7-38-25.8-42.7z" class="ij2"/>
                        <path d="M61.6 57.6c-5-22.9 16.9-33.5 21.2-34.2 7.6 5.9 13.2 14.3 15.4 24.4 3.7 17-3.3 33.8-16.5 43.5-14.4-4.6-15-10.8-20.1-33.7z" class="ij1"/>
                        <path d="M107.3 63.4c-.7-1.6-2-3-3.8-4.1 1.9-.3 3.5-1 4.8-2.2 1.2-1.2 2.1-2.9 2.7-5.1.8-3.1.2-5.8-1.6-8-1.4-1.7-3.7-3.1-6.8-4.2l1.5-6.1-4-1-1.5 5.9-3.1-.8L97 32l-4-1-1.5 5.9-5.7-1.4-1-.2-5.4-1.3-1 4 5.4 1.3-7.3 29.5-5.4-1.3-1 4 5.4 1.3 1 .2 5.7 1.4-1.3 5.4 4 1 1.3-5.4 3.1.8-1.3 5.4 4 1 1.4-5.6c3.5.6 6.4.3 8.7-.7 2.8-1.3 4.6-3.6 5.5-7 .5-2.3.4-4.3-.3-5.9zM104 51c-.4 1.8-1.4 2.9-2.8 3.4-1.4.6-3.2.6-5.5 0l-7.9-2 2.5-10 7.8 1.9c2.5.6 4.3 1.5 5.2 2.5.9 1.2 1.1 2.6.7 4.2zm-6.2 19.5c-1.5.6-3.7.5-6.6-.2l-7.4-1.8L86.4 58l7.5 1.8c2.7.7 4.6 1.6 5.7 2.7 1.1 1.1 1.4 2.6 1 4.4-.5 1.9-1.4 3-2.8 3.6z" class="ij2"/>
                        <circle cx="48.4" cy="56.3" r="38.7" class="ij0"/>
                        <path d="M22.2 74.8c-6.4-22.1 6.2-45.2 28.3-51.6 8-2.3 16.2-2.2 23.7.1-10.2-7.7-23.7-10.7-36.9-6.8C15.1 22.9 2.5 46 8.9 68 13 82 23.8 92.2 36.8 96.2c-6.7-5.2-12-12.5-14.6-21.4z" class="ij1"/>
                        <path d="M61 96.6c-22.4 6.5-45.9-6.3-52.4-28.7S14.9 22 37.2 15.5s45.9 6.3 52.4 28.7S83.3 90.1 61 96.6zM39.2 22.3c-18.6 5.4-29.3 25-23.9 43.6s25 29.3 43.6 23.9c18.6-5.4 29.3-25 23.9-43.6-5.4-18.6-25-29.3-43.6-23.9z" class="ij2"/>
                        <path d="M66 71.3c-2.3 2.9-5.5 4.9-9.6 6.1-4.8 1.4-9 1.3-12.4-.3-3.5-1.6-6.3-4.6-8.4-9.2l-5.1 1.5-1.5-5.2 4.7-1.4-1.2-4.1-4.7 1.4-1.6-5.1 5.1-1.5c-.6-4.9.2-9 2.3-12.3 2.1-3.4 5.5-5.7 10.3-7.1 4-1.2 7.8-1.2 11.2 0 3.4 1.2 6.1 3.4 7.9 6.7l-8.5 2.5c-1-1.3-2.1-2.1-3.5-2.5-1.4-.4-3.2-.3-5.4.4-2.5.7-4.3 2-5.4 3.7-1.1 1.7-1.5 3.9-1.4 6.5l19.7-5.8-.9 5.9-17.9 5.2 1.2 4.1L57.1 56l-.9 5.9-13.1 3.8c1.3 2.3 2.8 3.8 4.7 4.6 1.9.8 4.1.8 6.5.1 2.3-.7 3.9-1.6 4.8-2.8.9-1.2 1.5-2.7 1.8-4.6l8.5-2.5c.1 4.4-1.1 8-3.4 10.8z" class="ij2"/>
                      </svg>
                      <p>Financeiro</p>
                    </div>
                  </div>
                  <div class="xxlarge-3 xsmall-5 xsmall-offset-1 columns">
                    <div class="sectors-icons">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" viewBox="0 0 142 113">
                      <style>
                        .cd0{fill:#e5a58e}.cd1{fill:#411430}.cd4{fill:#ffca7c}
                      </style>
                      <path d="M69.1 1H32.7c-4.2 0-7.5 3.4-7.5 7.5v88.1c0 4.2 3.4 7.5 7.5 7.5h36.4c4.2 0 7.5-3.4 7.5-7.5v-88c0-4.2-3.3-7.6-7.5-7.6z" class="cd0"/>
                      <path d="M69.1 3.6h-5.9V4c0 1.8-1.4 3.2-3.2 3.2H41.2C39.4 7.2 38 5.8 38 4v-.4h-5.3c-2.8 0-5 2.3-5 5v88.1c0 2.8 2.3 5 5 5h36.4c2.8 0 5-2.3 5-5V8.6c0-2.8-2.2-5-5-5z" class="cd1"/>
                      <path fill="#b68276" d="M76.3 96.7v-71h-2.5v71c0 2.8-2.3 5-5 5H61v2.5h7.8c4.1 0 7.5-3.3 7.5-7.5z"/>
                      <path fill="#270c1c" d="M61 28.3v73.4h7.8c2.8 0 5-2.3 5-5v-71H63.5c-1.4 0-2.5 1.2-2.5 2.6z"/>
                      <path d="M40.6 55.4v7h-2.8V50.7h2.8l4.3 6.9v-6.9h2.8v11.7H45zM56.7 61.8c-.8.6-1.8.9-3.2.9-1.6 0-2.9-.4-3.6-1.3-.8-.9-1.2-2-1.2-3.5v-.3c0-.5 0-1 .1-1.4.1-.4.3-.8.5-1.2.4-.7 1-1.3 1.7-1.7.7-.4 1.6-.6 2.6-.6.6 0 1.1.1 1.5.2.5.1.9.3 1.2.5.7.4 1.2 1 1.5 1.7.3.7.5 1.5.5 2.4v1.1h-6.7c.1.6.3 1 .6 1.3.3.3.8.4 1.3.4.4 0 .7-.1 1-.2.2-.2.4-.4.5-.7h3.2c-.2 1-.7 1.8-1.5 2.4m-4.4-6.4c-.3.3-.5.7-.6 1.3h3.7c-.1-.5-.2-.9-.5-1.2-.3-.3-.7-.4-1.3-.4-.6-.1-1 0-1.3.3" class="cd4"/>
                      <path d="M62.8 59.7l-1.7 2.7h-3.5l3.5-4.9-3.2-4.6h3.4l1.6 2.4 1.5-2.4h3.4l-3.2 4.5 3.4 5h-3.4z" class="cd4"/>
                      <path fill="#f5b454" d="M61 57.3v.4l.1-.2z"/>
                      <path fill="#ec8b65" d="M62.8 59.7l1.8 2.7H68l-3.4-5 3.2-4.5h-3.4l-1.5 2.4-1.6-2.4H61v4.4l.1.2-.1.2v4.7h.1z"/>
                      <path d="M111.1 112H69.7c-1.4 0-2.6-1.1-2.6-2.6V23.3c0-1.4 1.1-2.6 2.6-2.6h41.4c1.4 0 2.6 1.1 2.6 2.6v86.2c0 1.4-1.2 2.5-2.6 2.5z" class="cd0"/>
                      <path d="M68.6 28.8h43.5v68.7H68.6zM90.4 109c-2.5 0-4.5-2-4.5-4.5s2-4.5 4.5-4.5 4.5 2 4.5 4.5-2 4.5-4.5 4.5zm0-8c-2 0-3.5 1.6-3.5 3.5s1.6 3.5 3.5 3.5 3.5-1.6 3.5-3.5-1.6-3.5-3.5-3.5zM85.6 24.7h9.6v1h-9.6z" class="cd1"/>
                      <path d="M93 62.4h-1.5c-.5 0-.9 0-1.3-.1s-.7-.2-.9-.3c-.5-.3-.9-.7-1.1-1.3-.2-.5-.2-1.3-.2-2.3v-3h-1.6V53h.5c.1 0 .3 0 .4-.1.3 0 .5-.1.7-.3.1-.2.2-.4.3-.8 0-.2 0-.4.1-.6v-.5h2.5v2.2H93v2.6h-2.3V58.6c0 .2 0 .4.1.5.1.3.2.4.5.5.2.1.6.1 1.1.1h.6v2.7z" class="cd4"/>
                    </svg>
                      <p>Telecomunicações</p>
                    </div>
                  </div>
                  <div class="xxlarge-3 xsmall-5 xsmall-offset-1 columns">
                    <div class="sectors-icons">
                      <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" viewBox="0 0 142 113">
                        <style>
                          .ef0{fill:#ffca7c}.ef2{fill:#411430}
                        </style>
                        <path d="M128.6 88H12.3C10.5 88 9 86.5 9 84.8V5.9c0-1.8 1.5-3.3 3.3-3.3h116.4c1.8 0 3.3 1.5 3.3 3.3v78.8c-.1 1.8-1.6 3.3-3.4 3.3z" class="ef0"/>
                        <path fill="#b68276" d="M131.9 5.9c0-1.8-1.5-3.3-3.3-3.3H12.3C10.5 2.7 9 4.1 9 5.9v5.9h122.9V5.9z"/>
                        <circle cx="14.4" cy="7.6" r="2.1" class="ef2"/>
                        <circle cx="21.6" cy="7.6" r="2.1" class="ef2"/>
                        <circle cx="28.9" cy="7.6" r="2.1" class="ef2"/>
                        <path d="M51.9 5.5h37.2v4.2H51.9z" class="ef2"/>
                        <path fill="#ec8b65" d="M96.8 72.8h-51l.1-21 .1-20.9h49.2l.8 20.9z"/>
                        <path fill="#d4744e" d="M46 30.9l9.4-2.8h30.5l9.3 2.8z"/>
                        <circle cx="60.4" cy="40.3" r="2.5" class="ef2"/>
                        <circle cx="80" cy="40.3" r="2.5" class="ef2"/>
                        <path d="M70.3 54c-6.6 0-10.7-5.1-10.7-13.4 0-.6.4-1 1-1s1 .4 1 1c0 5.5 2.3 11.4 8.7 11.4 6.1 0 8.7-3.4 8.7-11.4 0-.6.4-1 1-1s1 .4 1 1C81 46.4 79.9 54 70.3 54z" class="ef0"/>
                        <path fill="#f5b454" d="M109.8 87.9H103l-4.3-21.7 17.8 21.7z"/>
                        <path fill="#4d1838" d="M124.8 98.1l7.1-4L101 62.7l11.1 42.7 7.1-4.1 6.1 10.7 5.6-3.2z"/>
                      </svg>
                      <p>Retalho</p>
                    </div>
                  </div>
                  <div class="xxlarge-3 xsmall-5 xsmall-offset-1 columns">
                    <div class="sectors-icons">
                      <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" viewBox="0 0 142 113">
                        <style>
                          .gh0{fill:#4d1838}.gh3{fill:#ec8b65}
                        </style>
                        <path d="M76.4 72.7h29v10.7h-29z" class="gh0" transform="rotate(-141.508 90.935 78.01)"/>
                        <path fill="#e5a58e" d="M125.4 84.6c-9.6-6.3-19.7-12.8-22.6-14.4C98.7 68 94.3 73 91 76.5c-2.7 2.9-8.1 10.1-5.5 12.6 4.3 2.5 12 8.7 20.3 16.2 7.2 4.5 26.7-14.1 19.6-20.7z"/>
                        <path d="M21.8 44.9H47v2.7H21.8z" class="gh0" transform="scale(-1) rotate(34.88 147.147 -109.463)"/>
                        <path d="M40.3 77.3h10.1V80H40.3z" class="gh0" transform="matrix(-.9958 .09203 -.09203 -.9958 97.73 152.816)"/>
                        <path d="M27.5 36.2h26.8v2.7H27.5z" class="gh0" transform="rotate(-135.081 40.913 37.582)"/>
                        <path d="M37.1 28.8h25.5v2.7H37.1z" class="gh0" transform="rotate(-130.73 49.803 30.127)"/>
                        <path d="M50.6 24.9h21.2v2.7H50.6z" class="gh0" transform="rotate(-126.207 61.162 26.274)"/>
                        <circle cx="99.5" cy="80.3" r="3.7" class="gh0"/>
                        <path fill="#b68276" d="M82.1 83.7L95 68.2s1-5.5-.4-8.6c-1.1-2.5-21.8-27.1-23.9-29.5-8.2 2.7-26 17-30.6 25.7 4.7 3.5 8.4 6.1 10.1 7.6s1.7 3.8 1.9 5.5C54.1 71.3 65 84 65 84s9.6 2.3 17.1-.3z"/>
                        <path d="M60.3 31.8l6.7-4.7s-6.7-8.8-7.3-9.7c-1.2-.1-2.8.4-4.3 1.7-1.3 1-2.3 2.1-2.5 3 1.6 1.9 7.4 9.7 7.4 9.7zM51.2 19.7c-1.6-2.2-3.4-4.7-4.9-7-1-1.6-1.2-3.7.7-5.2 1.2-.9 3.2-1.4 5.2 1s5.8 6.9 5.8 6.9-2.3-.7-4.5.9c-.9.9-2.2 2.4-2.3 3.4zM51.9 38l6.2-5.2S47.7 21.4 47 20.6c-1.2 0-2.7.7-4.2 2.1-1.2 1.1-2.1 2.3-2.2 3.2C42.4 27.6 51.9 38 51.9 38zM37.8 22.7c-1.7-2-3.8-4.3-5.5-6.5-1.1-1.5-1.5-3.6.2-5.2 1.1-1 3.1-1.6 5.3.6l6.4 6.4s-2.4-.5-4.4 1.3c-.9.8-2 2.4-2 3.4zM43.3 45.1l6-5.6S37.7 28.1 36.9 27.4c-1.2 0-2.7.8-4 2.3-1.1 1.2-2 2.4-2 3.3 1.8 1.6 12.4 12.1 12.4 12.1zM28.4 30.6c-1.9-1.9-4-4.1-5.8-6.2-1.2-1.4-2.7-4.3-1-6 1.1-1.1 2.9-1.7 5.3.3 2.6 2.2 7.7 6.8 7.7 6.8s-2.4-.3-4.3 1.6c-.9.8-1.9 2.5-1.9 3.5zM37.6 53.6l5-6.4s-13.3-9.4-14.2-10c-1.2.2-2.5 1.2-3.6 2.9-.9 1.4-1.6 2.7-1.5 3.6 2.1 1.3 14.3 9.9 14.3 9.9zM21.4 42c-2.1-1.6-3-2.3-5.1-4.1-1.4-1.2-3.3-3.8-2-5.8.9-1.2 2.6-2.1 5.3-.6 2.9 1.7 7 4.4 7 4.4s-2.4.1-4 2.3c-.7 1-1.4 2.8-1.2 3.8zM65.7 83.8C65.5 81.2 55.5 69.3 52 69c-3.4 3-6.5 6.6-6.5 6.6s-.6 3.4.8 5.4 3.1 3 4.1 3.4c2.5 0 15.3-.6 15.3-.6zM45.4 83.2c-1.6-2.4-2-7.3-1.3-8.6-2.4-.5-5.4-.3-6.1 0-1.2-1-5.3-3.9-9.5-1.3-2.1 1.3-.8 2.8.3 3.4 1.1.6 7 3.5 6.7 3.2 0-.1 7.2 2.3 9.9 3.3z" class="gh3"/>
                        <path d="M21.4 42c.3.4 2.2-1 3.5-2.8s2.2-2.9 1.7-3.3c-1.5-.1-3.3.5-4.4 1.7-1 1.2-1.3 3.8-.8 4.4zM28.4 30.6c1.4.3 2.8-.9 3.8-1.7 1.1-1 2.2-2.8 2.4-3.4-1.7-.7-3.3 0-4.5.9-1 .8-2.5 3.4-1.7 4.2zM37.8 22.7c1.3.2 3.5-1.3 4.1-1.8.7-.5 2-2 2.3-3-2-.7-3.5-.1-4.7.8-1.1 1-2.3 3.3-1.7 4zM51.2 19.7c1.6.3 3.5-1 4.1-1.4.6-.4 2.6-2 2.8-2.8-1.5-.9-3.3-.6-4.7.3-1.4 1-2.5 2.7-2.2 3.9z" class="gh0"/>
                        <circle cx="67.3" cy="73.3" r="4.3" class="gh0"/>
                        <path d="M45.4 83.2c.7-.6 1-2.7.7-4.3-.2-1.2-1.4-4.2-2-4.3-.6.9-.9 2.9-.7 4.4.2 2 1.3 3.8 2 4.2z" class="gh0"/>
                      </svg>
                      <p>Saúde</p>
                    </div>
                  </div>
                  <div class="xxlarge-3 xsmall-5 xsmall-offset-1 columns">
                    <div class="sectors-icons">
                      <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" viewBox="0 0 142 113">
                        <style>
                          .kl0{fill:#b68276}.kl2{fill:#ffca7c}.kl3{fill:#cc9180}.kl5{fill:#e5a58e}.kl8{fill:#ec8b65}
                        </style>
                        <path d="M126.8 22.8H15.6V87h3.6V26.5h107.6z" class="kl0"/>
                        <path d="M123.2 22.8h3.6V87h-3.6z" class="kl0"/>
                        <path fill="#411430" d="M138.4 102H3.9l57.2-55.9h20.2z"/>
                        <path d="M65.2 102l5-55.9h.6L69 102zM73.3 102l-1.8-55.9h.6l5 55.9z" class="kl2"/>
                        <path d="M81.3 44.5h.4v1.6h-.4zM138.4 91.8h2.6V102h-2.6z" class="kl3"/>
                        <path fill="#ffb59c" d="M138.4 91.8L81.3 44.5v1.6l57.1 55.9z"/>
                        <path d="M141 91.8L81.6 44.5h-.3l57.1 47.3z" class="kl5"/>
                        <g>
                          <path d="M1.3 91.8h2.6V102H1.3z" class="kl3" transform="rotate(-180 2.645 96.915)"/>
                          <path fill="#a97d6e" d="M3.9 91.8l57.2-47.3v1.6L3.9 102z"/>
                          <path d="M1.3 91.8l59.4-47.3h.4L3.9 91.8z" class="kl5"/>
                        </g>
                        <path fill="#270c1c" d="M3.9 102h16.8l42.5-55.9h-2.1z"/>
                        <g>
                          <path d="M30.8 10.4h33.8v24.8H30.8z" class="kl8"/>
                          <path d="M41.3 23.5l6.4 7.9 6.4-7.9h-3.6v-8h-5.6v8z" class="kl2"/>
                          <g>
                            <path d="M77 10.4h33.8v24.8H77z" class="kl8"/>
                            <path d="M87.5 22l6.4-7.9 6.4 7.9h-3.6v8h-5.6v-8z" class="kl2"/>
                          </g>
                        </g>
                      </svg>
                      <p>Sector Público</p>
                    </div>
                  </div>
                  <div class="xxlarge-3 xsmall-5 xsmall-offset-1 columns">
                    <div class="sectors-icons">
                      <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" viewBox="0 0 142 113">
                        <style>
                          .mn0{fill:#c58f7e}.mn1{fill:#e5a58e}.mn4{fill:#ffca7c}
                        </style>
                        <path d="M90.9 67.7l-.4 6.3c-.1 2.1-1.8 3.7-3.9 3.7H54c-2.1 0-3.8-1.6-3.9-3.7l-.4-6.3H46l1 15c0 1.3 1.1 2.3 2.4 2.3h.2c.6 0 1.1-.5 1.1-1.2v-.7H90v.7c0 .6.5 1.2 1.1 1.2h.2c1.3 0 2.3-1 2.4-2.3l.9-15.1h-3.7z" class="mn0"/>
                        <path d="M118.3 107.6H22.4c-.9 0-1.6-.7-1.6-1.6v-2.2H120v2.2c-.1.9-.8 1.6-1.7 1.6z" class="mn1"/>
                        <path fill="#ffb59c" d="M118.6 105.2H22c-1 0-1.7-1.1-1.1-2l8-13.4c.4-.6 1-1 1.7-1h78.7c.7 0 1.3.3 1.6.9l8.8 13.4c.5.9-.1 2.1-1.1 2.1z"/>
                        <path d="M108.3 90.4H31.5l-7.6 13.4h92z" class="mn0"/>
                        <path d="M125.3 5.6c-36.5 3.2-73.5 3.2-110 0-1.5 0-2.7 1.2-2.7 2.7v61.5c0 3.2 2.7 5.6 5.9 5.3 34.4-3.2 69.2-3.2 103.6 0 3.2.3 5.9-2.2 5.9-5.3V8.4c0-1.5-1.2-2.8-2.7-2.8z" class="mn1"/>
                        <path fill="#411430" d="M124.5 69.9c-35.9-1.2-71.8-1.2-107.6 0V10.5c35.8 1.6 71.8 1.6 107.6 0v59.4z"/>
                        <path d="M70.2 54.2c-9.4 0-17.1-7.7-17.1-17.1S60.8 20 70.2 20s17.1 7.7 17.1 17.1-7.6 17.1-17.1 17.1zm0-33.2c-8.9 0-16.1 7.2-16.1 16.1s7.2 16.1 16.1 16.1S86.4 46 86.4 37.1 79.1 21 70.2 21z" class="mn4"/>
                        <path d="M81.8 49.8l-12.5-13L87 33.2l.1.5c.2 1.1.3 2.3.3 3.4 0 4.7-1.9 9-5.2 12.3l-.4.4zM71.2 37.4l10.6 10.9c2.9-3 4.6-7 4.6-11.2 0-.9-.1-1.8-.2-2.7l-15 3zM50.9 60.1h41.3v1H50.9z" class="mn4"/>
                      </svg>
                      <p>Serviços</p>
                    </div>
                  </div>
                  <div class="xxlarge-3 xsmall-5 xsmall-offset-1 columns">
                    <div class="sectors-icons">
                      <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" viewBox="0 0 142 113">
                        <style>
                          .ab0{fill:#c58f7e}.ab1{fill:#b68276}.ab2{fill:#e5a58e}.ab3{fill:#ffb59c}.ab4{fill:#411430}
                        </style>
                        <path d="M40.2 7.5h22.2v7.2H40.2z" class="ab0"/>
                        <path d="M105.5 31c.8 1.9 3.1 14.7 3.1 14.7l-27.3 34-6.7-8.2L105.5 31z" class="ab1"/>
                        <path d="M74.5 71.5L58.9 54.6l46.9-43.4 9.7 10.6z" class="ab0"/>
                        <path d="M50.2 105.5h76.2v6.5H50.2z" class="ab2"/>
                        <path d="M77.9 87.2h20.7v18.3H77.9z" class="ab0"/>
                        <path d="M72.5 92.7H104v8.2H72.5z" class="ab1"/>
                        <path d="M78.7 92.7h9.6v8.2h-9.6z" class="ab0"/>
                        <path d="M88.3 92.7h9.6v8.2h-9.6z" class="ab2"/>
                        <path d="M97.5 92.7h6.5v8.2h-6.5z" class="ab3"/>
                        <path d="M83.9 73.3L67.6 57c-5.1-5.1-13.3-5.1-18.4 0s-5.1 13.3 0 18.4l12.1 12h45.5V73.3H83.9z" class="ab2"/>
                        <circle cx="58.3" cy="66.2" r="4.5" class="ab4"/>
                        <path d="M53.3 65.4h10.1v1.4H53.3z" class="ab2" transform="rotate(-45.001 58.311 66.153)"/>
                        <path d="M58.9 19.3h45.3l4 2.4h7.3v-7.4c0-6.6-5.4-12-12-12H58.9v17z" class="ab2"/>
                        <path fill="#ffca7c" d="M67.8 2.5h2.7v16.8h-2.7z"/>
                        <circle cx="104.2" cy="11.6" r="11.3" class="ab3"/>
                        <circle cx="104.2" cy="11.6" r="5.3" class="ab4"/>
                        <path d="M98.3 10.8h11.9v1.7H98.3z" class="ab3" transform="rotate(45.001 104.233 11.61)"/>
                        <path d="M29 8.9h22.4v9H29z" class="ab2" transform="rotate(-136.187 40.138 13.36)"/>
                        <path d="M13.9 28.2l2.7 2.6 12.1-12.6 7.1 6.8-12.1 12.6 2.7 2.6 7.8-4.5 10.9-11.4L29 8.9 18 20.2z" class="ab4"/>
                        <path d="M77.9 87.3h20.7v2.6H77.9zM77.9 100.9h20.7v2.6H77.9z" class="ab1"/>
                      </svg>
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
              Shaping the <span class="word-next">Nex<picture><source srcset="/public/imgs/robot.png 1x, /public/imgs/robot@2x.png 2x"><img src="/public/imgs/robot.png" alt=""></picture><span class="word-t">t<sup>&reg;</sup></span></span><span class="word-future">future.</span>
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
                <li><a target="_blank" href="https://www.linkedin.com/company/nxt-engineering/">linkedin</a></li>
                <li><a target="_blank" href="https://www.itjobs.pt/emprego?company=4943">IT Jobs</a></li>
                <!-- 
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