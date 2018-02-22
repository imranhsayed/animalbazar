<?php
 /* Template Name: Elements */ 
/**
 * The template for displaying Pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Adforest
 */

?>
<?php get_header(); ?>
<?php global $adforest_theme; ?>
<div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section id="error" class="section-padding-80 components">
            <div class="container">
               <div class="row">
                  <div class="col-md-6 margin-bottom-40">
                     <div class="heading-title">
                        <h2>Alerts</h2>
                     </div>
                     <div role="alert" class="alert alert-success alert-dismissible">
                        <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&#10005;</span></button>
                        <strong>Warning</strong> - Lorem ipsum dolor sit amet voluptates donor paribus 
                     </div>
                     <div role="alert" class="alert alert-warning alert-dismissible">
                        <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&#10005;</span></button>
                        <strong>Warning</strong> - Lorem ipsum dolor sit amet voluptates donor paribus 
                     </div>
                     <div role="alert" class="alert alert-info alert-dismissible">
                        <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&#10005;</span></button>
                        <strong>Warning</strong> - Lorem ipsum dolor sit amet voluptates donor paribus 
                     </div>
                     <div role="alert" class="alert alert-danger alert-dismissible">
                        <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&#10005;</span></button>
                        <strong>Warning</strong> - Lorem ipsum dolor sit amet voluptates donor paribus 
                     </div>
                  </div>
                  <div class="col-md-6 margin-bottom-40">
                     <div class="heading-title">
                        <h2>Alerts With Outline</h2>
                     </div>
                     <div role="alert" class="alert alert-success alert-dismissible alert-outline">
                        <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&#10005;</span></button>
                        <strong>Warning</strong> - Lorem ipsum dolor sit amet voluptates donor paribus 
                     </div>
                     <div role="alert" class="alert alert-warning alert-dismissible alert-outline">
                        <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&#10005;</span></button>
                        <strong>Warning</strong> - Lorem ipsum dolor sit amet voluptates donor paribus 
                     </div>
                     <div role="alert" class="alert alert-info alert-dismissible alert-outline">
                        <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&#10005;</span></button>
                        <strong>Warning</strong> - Lorem ipsum dolor sit amet voluptates donor paribus 
                     </div>
                     <div role="alert" class="alert alert-danger alert-dismissible alert-outline">
                        <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&#10005;</span></button>
                        <strong>Warning</strong> - Lorem ipsum dolor sit amet voluptates donor paribus 
                     </div>
                  </div>
               </div>
               <!-- =-=-=-=-=-=-= Accordians =-=-=-=-=-=-= -->
               <div class="row">
                  <div class="col-md-6 margin-bottom-40">
                     <div class="heading-title">
                        <h2>Accordion - 1</h2>
                     </div>
                     <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
                        <div class="panel panel-default">
                           <div id="headingOne" role="tab" class="panel-heading">
                              <h4 class="panel-title"> <a aria-controls="collapseOne" aria-expanded="false" href="#collapseOne" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"> Lorem ipsum dolor sit amet voluptates donor paribus </a> </h4>
                           </div>
                           <div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse" id="collapseOne" aria-expanded="false" style="height: 0px;">
                              <div class="panel-body"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel sapien at risus commodo varius vel ut sapien. Aenean sodales non ex et venenatis. In hac habitasse platea dictumst. Donec vitae tellus non erat dapibus hendrerit. Class aptent taciti <strong>bold text lorem ipsum</strong> per conubia nostra, per inceptos himenaeos. Sed ornare vestibulum aliquet. Suspendisse quis massa ac turpis euismod lacinia eget a lorem. Curabitur at ornare augue. Sed condimentum dolor nec neque fringilla, non consequat mauris lobortis. Ut nec eros sem. </div>
                           </div>
                        </div>
                        <div class="panel panel-default">
                           <div id="headingTwo" role="tab" class="panel-heading">
                              <h4 class="panel-title"> <a aria-controls="collapseTwo" aria-expanded="false" href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"> Dolor sit amet voluptates donor paribus </a> </h4>
                           </div>
                           <div aria-labelledby="headingTwo" role="tabpanel" class="panel-collapse collapse" id="collapseTwo" aria-expanded="false">
                              <div class="panel-body"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel sapien at risus commodo varius vel ut sapien. Aenean sodales non ex et venenatis. In hac habitasse platea dictumst. Donec vitae tellus non erat dapibus hendrerit. Class aptent taciti <strong>bold text lorem ipsum</strong> per conubia nostra, per inceptos himenaeos. Sed ornare vestibulum aliquet. Suspendisse quis massa ac turpis euismod lacinia eget a lorem. Curabitur at ornare augue. Sed condimentum dolor nec neque fringilla, non consequat mauris lobortis. Ut nec eros sem. </div>
                           </div>
                        </div>
                        <div class="panel panel-default">
                           <div id="headingThree" role="tab" class="panel-heading">
                              <h4 class="panel-title"> <a aria-controls="collapseThree" aria-expanded="false" href="#collapseThree" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"> Verdum libero ipsum dolor sit amet voluptates donor paribus </a> </h4>
                           </div>
                           <div aria-labelledby="headingThree" role="tabpanel" class="panel-collapse collapse" id="collapseThree" aria-expanded="false" style="height: 0px;">
                              <div class="panel-body"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel sapien at risus commodo varius vel ut sapien. Aenean sodales non ex et venenatis. In hac habitasse platea dictumst. Donec vitae tellus non erat dapibus hendrerit. Class aptent taciti <strong>bold text lorem ipsum</strong> per conubia nostra, per inceptos himenaeos. Sed ornare vestibulum aliquet. Suspendisse quis massa ac turpis euismod lacinia eget a lorem. Curabitur at ornare augue. Sed condimentum dolor nec neque fringilla, non consequat mauris lobortis. Ut nec eros sem. </div>
                           </div>
                        </div>
                        <div class="panel panel-default">
                           <div id="headingFour" role="tab" class="panel-heading">
                              <h4 class="panel-title"> <a aria-controls="collapseFour" aria-expanded="false" href="#collapseFour" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"> Lorem ipsum dolor sit amet voluptates donor paribus </a> </h4>
                           </div>
                           <div aria-labelledby="headingFour" role="tabpanel" class="panel-collapse collapse" id="collapseFour" aria-expanded="false">
                              <div class="panel-body"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel sapien at risus commodo varius vel ut sapien. Aenean sodales non ex et venenatis. In hac habitasse platea dictumst. Donec vitae tellus non erat dapibus hendrerit. Class aptent taciti <strong>bold text lorem ipsum</strong> per conubia nostra, per inceptos himenaeos. Sed ornare vestibulum aliquet. Suspendisse quis massa ac turpis euismod lacinia eget a lorem. Curabitur at ornare augue. Sed condimentum dolor nec neque fringilla, non consequat mauris lobortis. Ut nec eros sem. </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 margin-bottom-40">
                     <div class="heading-title">
                        <h2>Accordion - 2</h2>
                     </div>
                     <ul class="accordion">
                        <li>
                           <h3 class="accordion-title"><a href="#">How do I use this theme?</a></h3>
                           <div class="accordion-content">
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vehicula bibendum sapien, quis vehicula tellus imperdiet non. Ut efficitur ultrices ullamcorper Aliquam a vehicula ex. In metus purus, iaculis vulputate feugiat et, semper in dolor. Aliquam dui urna, sodales.Nam porttitor ex est, et elementum turpis viverra sed. Phasellus elementum magna urna, ut efficitur sem malesuada vitae. Aenean luctus lorem eget porttitor imperdiet. Suspendisse sit amet hendrerit eros. Donec sapien nulla, fringilla eget magna sit amet, placerat suscipit urna. Ut pretium, purus a posuere sagittis.</p>
                           </div>
                        </li>
                        <li>
                           <h3 class="accordion-title"><a href="#">Do memberships include the original PSD files?</a></h3>
                           <div class="accordion-content">
                              <p>Nullam ultricies, tellus id accumsan dictum, erat quam auctor tortor, vitae ullamcorper sapien dui sit amet arcu. Aenean eu sem finibus, iaculis nisi vel, facilisis nunc.</p>
                           </div>
                        </li>
                        <li>
                           <h3 class="accordion-title"><a href="#">How can I purchase a single theme?</a></h3>
                           <div class="accordion-content">
                              <p>Vestibulum quis orci condimentum, sodales purus at, malesuada mi. Sed a tristique est. Sed vehicula pharetra sem, at efficitur elit lacinia eu. Vivamus porttitor mauris ex, non facilisis dolor aliquam non. Sed urna mi, suscipit vehicula dapibus id, consequat vestibulum enim. Phasellus dignissim metus lorem.</p>
                           </div>
                        </li>
                        <li>
                           <h3 class="accordion-title"><a href="#">Want to develop in Wordpress? Lets get started</a></h3>
                           <div class="accordion-content">
                              <p>It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
               <!-- =-=-=-=-=-=-= Tabs =-=-=-=-=-=-= -->
               <div class="row">
                  <div class="col-md-6  margin-bottom-40">
                     <div class="heading-title">
                        <h2>Material Tabs </h2>
                     </div>
                     <!-- Nav tabs -->
                     <div class="card">
                        <ul class="nav nav-tabs" role="tablist">
                           <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
                           <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
                           <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
                           <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                           <div role="tabpanel" class="tab-pane active" id="home">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
                           <div role="tabpanel" class="tab-pane" id="profile">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
                           <div role="tabpanel" class="tab-pane" id="messages">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
                           <div role="tabpanel" class="tab-pane" id="settings">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passage..</div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 margin-bottom-40">
                     <div class="heading-title">
                        <h2>Simple Tabs </h2>
                     </div>
                     <div class="panel with-nav-tabs panel-default">
                        <div class="panel-heading">
                           <ul class="nav nav-tabs">
                              <li class="active"><a href="#tab1default" data-toggle="tab">Default 1</a></li>
                              <li><a href="#tab2default" data-toggle="tab">Default 2</a></li>
                              <li><a href="#tab3default" data-toggle="tab">Default 3</a></li>
                              <li class="dropdown">
                                 <a href="#" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                                 <ul class="dropdown-menu" role="menu">
                                    <li><a href="#tab4default" data-toggle="tab">Default 4</a></li>
                                    <li><a href="#tab5default" data-toggle="tab">Default 5</a></li>
                                 </ul>
                              </li>
                           </ul>
                        </div>
                        <div class="panel-body">
                           <div class="tab-content">
                              <div class="tab-pane fade in active" id="tab1default">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
                              <div class="tab-pane fade" id="tab2default">Default 2</div>
                              <div class="tab-pane fade" id="tab3default">Default 3</div>
                              <div class="tab-pane fade" id="tab4default">Default 4</div>
                              <div class="tab-pane fade" id="tab5default">Default 5</div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- =-=-=-=-=-=-= Breadcrumbs =-=-=-=-=-=-= -->
               <div class="row">
                  <div class="col-md-12 margin-bottom-40">
                     <div class="heading-title">
                        <h2>Breadcrumbs</h2>
                     </div>
                     <ol class="breadcrumb">
                        <li><a href="">Sharpen</a></li>
                        <li class="active">Active page</li>
                     </ol>
                     <br>
                     <ol class="breadcrumb">
                        <li><a href="">Sharpen</a></li>
                        <li><a href="#">UI elements</a></li>
                        <li><a href="#">Breadcrumbs</a></li>
                        <li><a href="#">Active parent</a></li>
                        <li class="active">Active page</li>
                     </ol>
                  </div>
               </div>
               <!-- =-=-=-=-=-=-= Labels =-=-=-=-=-=-= -->
               <div class="row">
                  <div class="col-md-6 margin-bottom-40">
                     <div class="heading-title">
                        <h2>Labels </h2>
                     </div>
                     <p> <span class="label label-primary">Primary</span> <span class="label label-success">Success</span> <span class="label label-info">Info</span> <span class="label label-warning">Warning</span> <span class="label label-danger">Danger</span> </p>
                  </div>
                  <div class="col-md-6 margin-bottom-40">
                     <div class="heading-title">
                        <h2>Loading Buttons </h2>
                     </div>
                     <button class="btn btn-blue btn-lg"><i class="fa fa-circle-o-notch fa-spin"></i> Loading</button>
                     <button class="btn btn-danger btn-lg"><i class="fa fa-refresh fa-spin"></i> Loading</button>
                     <button class="btn btn-info btn-lg"><i class="fa fa-spinner fa-spin"></i> Loading</button>
                  </div>
               </div>
               <!-- =-=-=-=-=-=-= Buttons =-=-=-=-=-=-= -->
               <div class="row">
                  <div class="col-md-6 col-xs-12 col-lg-6 margin-bottom-40">
                     <div class="heading-title">
                        <h2>Normal Buttons </h2>
                     </div>
                     <code class="margin-bottom-30">btn btn-default</code>
                     <p class="margin-top-20">
                        <button class="btn btn-default margin-bottom-10" type="button">Default</button>
                        <button class="btn btn-primary margin-bottom-10" type="button">Primary</button>
                        <button class="btn btn-success margin-bottom-10" type="button">Success</button>
                        <button class="btn btn-info margin-bottom-10" type="button">Info</button>
                        <button class="btn btn-warning margin-bottom-10" type="button">Warning</button>
                        <button class="btn btn-danger margin-bottom-10" type="button">Danger</button>
                        <button class="btn btn-link margin-bottom-10" type="button">Link</button>
                     </p>
                     <br>
                     <div class="heading-title">
                        <h2>Button Sizes </h2>
                     </div>
                     <p>
                        <button class="btn btn-purple btn-lg margin-bottom-10" type="button">Large button</button>
                        <button class="btn btn-blue margin-bottom-10" type="button">Default button</button>
                        <button class="btn btn-success btn-sm margin-bottom-10" type="button">Small button</button>
                        <button class="btn btn-danger btn-xs margin-bottom-10" type="button">Mini button</button>
                     </p>
                  </div>
                  <div class="col-md-6 col-xs-12 col-lg-6 margin-bottom-40">
                     <div class="heading-title">
                        <h2>Outline Buttons </h2>
                     </div>
                     <code class="margin-bottom-30">btn btn-outline btn-default</code>
                     <p class="margin-top-20">
                        <button class="btn btn-outline btn-default  margin-bottom-10" type="button">Default</button>
                        <button class="btn btn-outline btn-success  margin-bottom-10" type="button">Success</button>
                        <button class="btn btn-outline btn-info  margin-bottom-10" type="button">Info</button>
                        <button class="btn btn-outline btn-warning  margin-bottom-10" type="button">Warning</button>
                        <button class="btn btn-outline btn-danger  margin-bottom-10" type="button">Danger</button>
                        <button class="btn btn-outline btn-link  margin-bottom-10" type="button">Link</button>
                     </p>
                     <br>
                     <br>
                     <button class="btn btn-theme btn-lg btn-block" type="button">Block level button</button>
                  </div>
               </div>
               <!-- Row End --> 
            </div>
            <!-- end container --> 
         </section>
         <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
      </div>
<!--footer section-->
<?php get_footer(); ?>