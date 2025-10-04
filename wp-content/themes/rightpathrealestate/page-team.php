<?php
/**
 * Template Name: Team Page
 */

get_header();
?>

<!-- Sub banner start -->
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>Team Member</h1>
            <ul class="breadcrumbs">
                <li><a href="<?php echo home_url(); ?>">Home</a></li>
                <li class="active">Team Member</li>
            </ul>
        </div>        
    </div>
</div>
<!-- Sub banner end -->


<!-- Split Section start -->
<section class="split-section">
  <div class="split-image">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/property/img-21.jpg" alt="Office">
  </div>
  <div class="split-content">
    <h2>
      Create impact with a <br>
      innovative and <br>growth-focused team.
    </h2>
    <div class="col-lg-12" style = "top:10px; left: -5px; border-radius: 1;">
            <a href="contact.html" class="btn-5">Get in Touch</a>
        </div>
  </div>
    <!-- <a href="#" class="btn-outline">Get in touch</a> -->
</section>

<!-- Split Section end -->

<!-- agent start -->
    <div class="agent content-area-2">
        <div class="container">
            <div class="main-title">
                <p>Meet our experienced and dedicated real estate professionals who make it all happen.</p>
            </div>
            <div class="row">
                <!-- Agent 1 -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="agent-3">
                        <div class="photo">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar/avatar-5.png" alt="agent-1" class="img-fluid">
                            <div class="agent-overlay"></div>
                        </div>
                        <div class="agent-details text-center">
                            <h5><a href="#">Anjal Mann | Director</a></h5>
                            <blockquote>"Welcome to our team! Let’s achieve excellence together with passion and dedication."</blockquote>
                            <div class="contact">
                                <p>
                                    <a href="javascript:void(0)" class="call-toggle" data-phone="0434055559">Call Me</a> | 
                                    <a href="mailto:anjal@rightpathrealestate.com.au"> Email Me</a>
                                </p>
                            </div>
                            <ul class="social-list clearfix">
                                <li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="instagram-bg"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#" class="linkedin-bg"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Agent 2 -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="agent-3">
                        <div class="photo">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar/avatar-7.png" alt="agent-2" class="img-fluid">
                            <div class="agent-overlay"></div>
                        </div>
                        <div class="agent-details text-center">
                            <h5><a href="#">Kuljeet Singh | Sales Director</a></h5>
                            <blockquote>"Welcome to our team! Let’s achieve excellence together with passion and dedication."</blockquote>
                            <div class="contact">
                                <p>
                                     <a href="javascript:void(0)" class="call-toggle" data-phone="0434055559">Call Me</a> | 
                                    <a href="mailto:kuljeet@rightpathrealestate.com.au"> Email Me</a>
                                </p>
                            </div>
                            <ul class="social-list clearfix">
                                <li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="instagram-bg"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#" class="linkedin-bg"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- agent start -->
    <div class="agent content-area-2">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">Find Our Expert Agents</h3>

                <!-- Dynamic Dropdown -->
                <?php 
                // Get all unique cities from agents
                $cities = [];
                $agents_query = new WP_Query([
                    'post_type' => 'agent',
                    'posts_per_page' => -1
                ]);
                if($agents_query->have_posts()):
                    while($agents_query->have_posts()): $agents_query->the_post();
                        $city = get_field('city');
                        if($city && !in_array($city, $cities)){
                            $cities[] = $city;
                        }
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
                <div class="custom-dropdown fancy-dropdown">
                    <div class="dropdown-selected">All Cities</div>
                    <ul class="dropdown-options">
                        <li data-value="all" class="selected">All Cities</li>
                        <?php foreach($cities as $city): ?>
                            <li data-value="<?php echo strtolower($city); ?>"><?php echo esc_html($city); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <input type="hidden" id="agentFilter" value="all">
            </div>

            <div class="row" id="agentList">
                <?php
                // Query Agents again for cards
                $agents = new WP_Query([
                    'post_type' => 'agent',
                    'posts_per_page' => -1
                ]);
                if($agents->have_posts()):
                    while($agents->have_posts()): $agents->the_post();
                        $position = get_field('position');
                        $phone    = get_field('phone');
                        $email    = get_field('email');
                        $city     = get_field('city');
                        $facebook = get_field('facebook');
                        $twitter  = get_field('twitter');
                        $instagram= get_field('instagram');
                        $linkedin = get_field('linkedin');
                        $photo    = get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: get_template_directory_uri() . '/assets/img/avatar/avatar.png';
                ?>
                <div class="col-lg-3 col-md-6 col-sm-6 agent-card" data-city="<?php echo strtolower($city); ?>">
                    <div class="agent-1">
                        <div class="agent-inner">
                            <div class="inner-top">
                                <div class="photo">
                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($photo); ?>" class="img-circle" alt="<?php the_title(); ?>"></a>
                                </div>
                                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php if($position): ?><p><?php echo esc_html($position); ?></p><?php endif; ?>
                                <p class="call-area">
                                    <?php if($phone): ?>
                                        <a href="javascript:void(0)" class="call-toggle" data-phone="<?php echo esc_attr($phone); ?>">Call Me</a>
                                    <?php endif; ?>
                                    <?php if($phone && $email): ?> | <?php endif; ?>
                                    <?php if($email): ?>
                                        <a href="mailto:<?php echo esc_attr($email); ?>">Email Me</a>
                                    <?php endif; ?>
                                </p>
                                <ul class="social-list clearfix">
                                    <?php if($facebook): ?><li><a href="<?php echo esc_url($facebook); ?>" class="facebook"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
                                    <?php if($twitter): ?><li><a href="<?php echo esc_url($twitter); ?>" class="twitter"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
                                    <?php if($instagram): ?><li><a href="<?php echo esc_url($instagram); ?>" class="instagram"><i class="fa fa-instagram"></i></a></li><?php endif; ?>
                                    <?php if($linkedin): ?><li><a href="<?php echo esc_url($linkedin); ?>" class="linkedin"><i class="fa fa-linkedin"></i></a></li><?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata(); endif; ?>
            </div>
        </div>
    </div>
    <!-- agent end -->


<?php get_footer(); ?>
