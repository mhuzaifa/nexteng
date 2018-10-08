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
    <header class="page-header header-purple">

      <article class="carousel-wrapper">
        <div class="carousel-content inspire">
          <div class="logo-container">
            <svg id="logo" viewBox="0 0 942 202">
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
          <h3 class="carousel--slogan">Inspire and you’ll be next in line to be inspired</h3>
        </div>
      </article>


    </header>
  </div>

  <main class="page-content" role="main">
    <!-- SERVICE  -->
    <article class="service">
      <div class="row expanded">
        <div class="xxlarge-8 xxlarge-offset-2 xlarge-8 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-1 columns">
          <h3 class="service--title">
            <font style="vertical-align: inherit;">
              <font style="vertical-align: inherit;">
                Being Nex t is to be malleable. </font>
              <font style="vertical-align: inherit;">We believe that fluency guides knowledge to innovation.
              </font>
            </font>
          </h3>
        </div>
      </div>
      <div class="row expanded">
        <div class="xxlarge-4 xxlarge-offset-2 xlarge-4 xlarge-offset-2 medium-5 medium-offset-1 xsmall-10 xsmall-offset-1 columns">
          <div class="service--box consultoria">
            <h4>
              <font style="vertical-align: inherit;"></font><br>
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">Specialized
                </font>
                <font style="vertical-align: inherit;">
                  Consulting</font>
              </font>
            </h4>
          </div>
          <div class="service--box projectos">
            <h4>
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">
                  Projects
                </font>
              </font>
            </h4>
          </div>
        </div>
        <div class="xxlarge-4 xxlarge-offset-0 xlarge-4 xlarge-offset-0 medium-5 medium-offset-0 xsmall-10 xsmall-offset-1 columns">
          <p class="service--subtitle">
            <font style="vertical-align: inherit;">
              <font style="vertical-align: inherit;">
                We are a 100% Portuguese technology consultant, but what sets us apart is curiosity. </font>
              <font style="vertical-align: inherit;">We see actuality as past and nonconformity as a daily goal.
              </font>
            </font>
          </p>
          <div class="service--box projectos">
            <h4>
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">
                  Nearshore
                </font>
              </font>
            </h4>
          </div>
          <p class="service--note">
            <font style="vertical-align: inherit;">
              <font style="vertical-align: inherit;">
                We are pragmatic and strategic in terms of one objective: to always get the best projects for our
                Employees.&nbsp;
              </font>
            </font>
          </p>
        </div>
      </div>
    </article>
    <!-- MANIFESTO  -->
    <article class="manifesto">
      <div class="row expanded">
        <div class="xxlarge-5 xxlarge-offset-2 xlarge-5 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-1 columns">
          <h3 class="manifesto--title">
            <font style="vertical-align: inherit;">
              <font style="vertical-align: inherit;"> Your next manifesto</font>
            </font>
          </h3>
        </div>
      </div>
      <div class="row expanded">
        <div class="xxlarge-5 xxlarge-offset-2 xlarge-5 xlarge-offset-2 medium-5 medium-offset-1 xsmall-6 xsmall-offset-1 columns">
          <p class="manifesto--single">
            <font style="vertical-align: inherit;">
              <font style="vertical-align: inherit;">
                Growth is always within reach. </font>
              <font style="vertical-align: inherit;">By sharing, we create space for new ideas. </font>
              <font style="vertical-align: inherit;">Celebrate success with everyone.
              </font>
            </font>
          </p>
        </div>
        <div class="xxlarge-3 xlarge-3 medium-3 medium-offset-1 xsmall-2 columns">
          <div class="menifesto-img">
            <p>
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">menifesto-img</font>
              </font>
            </p>
          </div>
        </div>
      </div>
    </article>
    <!--  SECTORS: Info Tech -->
    <article class="sectors info-tech">
      <div class="row expanded">
        <div class="xxlarge-6 xxlarge-offset-2 xlarge-6 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-1 columns">
          <h3 class="sectors-title">
            <font style="vertical-align: inherit;">
              <font style="vertical-align: inherit;">
                The Nex t Information Technology.
              </font>
            </font>
          </h3>
        </div>
      </div>
      <div class="row expanded">
        <div class="xxlarge-8 xxlarge-offset-2 xlarge-8 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-1">
          <div class="row expanded">
            <div class="xxlarge-2 xlarge-2 medium-6 medium-offset-0 xsmall-10 xsmall-offset-0 columns">
              <div class="sectors-box">
                <h5 class="sectors-box--title">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                      Development
                    </font>
                  </font>
                </h5>
                <ul class="sectors-box--list">
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Microsoft</font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Oracle</font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Opensource</font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">SAP</font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Outsystems</font>
                    </font>
                  </li>
                </ul>
              </div>
              <div class="sectors-box">
                <h5 class="sectors-box--title">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                      Middleware
                    </font>
                  </font>
                </h5>
                <ul class="sectors-box--list">
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">IBM Websphere</font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Jboss</font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">SAP</font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">TIBCO</font>
                    </font>
                  </li>
                </ul>
              </div>
            </div>
            <div class="xxlarge-2 xxlarge-offset-1 xlarge-2 xlarge-offset-1 medium-6 medium-offset-0 xsmall-10 xsmall-offset-0 columns">
              <div class="sectors-box">
                <h5 class="sectors-box--title">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                      Infrastructures
                    </font>
                  </font>
                </h5>
                <ul class="sectors-box--list">
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Networking </font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Security </font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">System Administration </font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Cloud </font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Virtualization </font>
                    </font>
                  </li>
                </ul>
              </div>
              <div class="sectors-box two-line">
                <h5 class="sectors-box--title">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                      QA / Testing
                    </font>
                  </font>
                </h5>
                <ul class="sectors-box--list">
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Selenium </font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Visual Studio </font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Cucumber </font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Appium </font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">HP Quality Center </font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Jira </font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Testlink </font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Squash Test </font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Robotframework </font>
                    </font>
                  </li>
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                    </font>
                  </font>
                </ul>
              </div>
            </div>
            <div class="xxlarge-2 xxlarge-offset-1 xlarge-2 xlarge-offset-1 medium-6 medium-offset-0 xsmall-10 xsmall-offset-0 columns">
              <div class="sectors-box top-offset">
                <h5 class="sectors-box--title">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                      Business Intelligence
                    </font>
                  </font>
                </h5>
                <ul class="sectors-box--list">
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Microsoft </font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Oracle </font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">IBM </font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">SAP </font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Sybase </font>
                    </font>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </article>
    <!--  SECTORS: Big Data -->
    <article class="sectors big-data">
      <div class="row expanded">
        <div class="xxlarge-6 xxlarge-offset-2 xlarge-6 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-1 columns">
          <h3 class="sectors--title">
            <font style="vertical-align: inherit;">
              <font style="vertical-align: inherit;">
                The Nex t Big Data
              </font>
            </font>
          </h3>
        </div>
      </div>
      <div class="row expanded">
        <div class="xxlarge-8 xxlarge-offset-2 xlarge-8 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-1">
          <div class="row expanded">
            <div class="xxlarge-2 xlarge-2 medium-6 medium-offset-0 xsmall-10 xsmall-offset-0 columns">
              <div class="sectors-box">
                <h5 class="sectors-box--title">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                      Digital marketing
                    </font>
                  </font>
                </h5>
                <ul class="sectors-box--list">
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">SEO / SEM </font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">CRM</font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Content Marketing</font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">E-commerce</font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Web App</font>
                    </font>
                  </li>
                </ul>
              </div>
            </div>
            <div class="xxlarge-2 xxlarge-offset-1 xlarge-2 xlarge-offset-1 medium-6 medium-offset-0 xsmall-10 xsmall-offset-0 columns">
              <div class="sectors-box">
                <h5 class="sectors-box--title">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                      Data Science / Data Mining
                    </font>
                  </font>
                </h5>
                <ul class="sectors-box--list">
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Machine Learning</font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">NLP</font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Hadoop, Spark, Cloudera</font>
                    </font>
                  </li>
                  <li>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">R, Python.</font>
                    </font>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </article>
    <!--  SECTORS: RPA -->
    <article class="sectors rpa">
      <div class="row expanded">
        <div class="xxlarge-6 xxlarge-offset-2 xlarge-6 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-1 columns">
          <h3 class="sectors--title">
            <font style="vertical-align: inherit;">
              <font style="vertical-align: inherit;">
                The Nex t RPA </font>
            </font><span>
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">*</font>
              </font>
            </span>
          </h3>
        </div>
      </div>
      <div class="row expanded">
        <div class="xxlarge-8 xxlarge-offset-2 xlarge-8 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-0">
          <div class="row expanded">
            <div class="xxlarge-3 xlarge-3 medium-6 medium-offset-0 xsmall-10 xsmall-offset-1 columns">
              <div class="sectors-box">
                <h5 class="sectors-box--title">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                      Blue Prism </font>
                  </font><br>
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                      UiPath </font>
                  </font><br>
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                      Automation Anywhere
                    </font>
                  </font>
                </h5>
              </div>
              <p class="note">
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">* Robotic Process Automation is a disruptive technology that
                    allows you to perform routine activities, usually executed manually, in an automatic way, making
                    operations more efficient and more agile in your business processes.</font>
                </font>
              </p>
            </div>
          </div>
        </div>
      </div>
    </article>
    <!--  SECTORS: ATIVIDADE -->
    <article class="sectors active">
      <div class="row expanded">
        <div class="xxlarge-6 xxlarge-offset-2 xlarge-6 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-1 columns">
          <h3 class="sectors--title">
            <font style="vertical-align: inherit;">
              <font style="vertical-align: inherit;">
                The Nex t Sectors
              </font>
            </font>
          </h3>
        </div>
      </div>
      <div class="row expanded">
        <div class="xxlarge-8 xxlarge-offset-2 xlarge-8 xlarge-offset-2 medium-8 medium-offset-1 xsmall-10 xsmall-offset-0">
          <div class="row expanded">
            <div class="xxlarge-3 xsmall-6 xsmall-offset-1 columns">
              <div class="sectors-icons">
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">
                    one
                  </font>
                </font>
              </div>
            </div>
            <div class="xxlarge-3 xsmall-6 xsmall-offset-1 columns">
              <div class="sectors-icons">
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">
                    two
                  </font>
                </font>
              </div>
            </div>
            <div class="xxlarge-3 xsmall-6 xsmall-offset-1 columns">
              <div class="sectors-icons">
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">
                    three
                  </font>
                </font>
              </div>
            </div>
            <div class="xxlarge-3 xsmall-6 xsmall-offset-1 columns">
              <div class="sectors-icons">
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">
                    four
                  </font>
                </font>
              </div>
            </div>
            <div class="xxlarge-3 xsmall-6 xsmall-offset-1 columns">
              <div class="sectors-icons">
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">
                    five
                  </font>
                </font>
              </div>
            </div>
            <div class="xxlarge-3 xsmall-6 xsmall-offset-1 columns">
              <div class="sectors-icons">
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">
                    six
                  </font>
                </font>
              </div>
            </div>
            <div class="xxlarge-3 xsmall-6 xsmall-offset-1 columns">
              <div class="sectors-icons">
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">
                    seven
                  </font>
                </font>
              </div>
            </div>
          </div>
        </div>
      </div>
    </article>
    <!-- ============= FOOTER ============= -->
    <article class="footer">
      <div class="xxlarge-10 xxlarge-offset-2 medium-offset-1 columns">
        <div class="footer-slogan">
          <span>Shaping the Next Future</span>
        </div>
        <address>
          <p>
            Avenida 5 de Outubro, nº 125, 4º
            1050-052 Lisboa
          </p>
        </address>
        <div class="contact">
          <a href="mailto:your@nextengineering.com">your@nextengineering.com</a>
          <p></p>
          <a href="">+351.213.749.294</a>
        </div>
        <div class="social">
          <ul>
            <li>twitter</li>
            <li>linkedin</li>
            <li>instagram</li>
            <li>facebook</li>
          </ul>
        </div>
      </div>
    </article>
  </main>


</div>

<div class="page-main page-next" aria-hidden="true"></div>
<div class="page-main page-prev" aria-hidden="true"></div>