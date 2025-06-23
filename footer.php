</main>
<footer class="site-footer">
    <div class="footer-container">

        <div class="footer-main-grid">

            <div class="footer-about-section">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-site-logo"><strong><?php bloginfo('name'); ?></strong></a>
                <h3 class="footer-welcome-heading">Welcome to Howtoinfo</h3>
                <p class="footer-description-paragraph">
                    Howtoinfo.xyz is your trusted hub for exploring, learning, and downloading the latest Android apps and games. Our mission is to empower users with reliable how-to guides, expert reviews, and a curated selection of safe, verified APK files.
                </p>
            </div>

            <div class="footer-links-section">
                <h3>Pages</h3>
                <ul>
                    <li><a href="<?php echo get_permalink(get_page_by_title('About Us')); ?>">About Us</a></li>
                    <li><a href="<?php echo get_permalink(get_page_by_title('Contact Us')); ?>">Contact Us</a></li>
                    <li><a href="<?php echo get_permalink(get_page_by_title('Privacy Policy for HowToInfo')); ?>">Privacy Policy</a></li>
                    <li><a href="<?php echo get_permalink(get_page_by_title('DMC Removal Policy')); ?>">DMC Removal Policy</a></li>
                </ul>
            </div>

            <div class="footer-links-section">
                <h3>Recently Updated</h3>
                <ul>
                    <?php
                        $args = array(
                            'post_type'      => 'post',
                            'posts_per_page' => 5,
                        );
                        $recent_posts = new WP_Query($args);
                        if ($recent_posts->have_posts()) :
                            while ($recent_posts->have_posts()) : $recent_posts->the_post();
                    ?>
                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                    ?>
                        <li>No recent posts found.</li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="footer-bottom-bar">
                <div class="footer-social-row">
                    <a href="https://www.facebook.com/profile.php?id=61577764855797" target="_blank" aria-label="Facebook" class="social-icon facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://pin.it/2AzSlx7os" target="_blank" aria-label="Pinterest" class="social-icon pinterest">
                        <i class="fab fa-pinterest-p"></i>
                    </a>
                    <a href="https://x.com/hasnainhabib_09" target="_blank" aria-label="X (Twitter)" class="social-icon twitter">
                        <i class="fab fa-x-twitter"></i>
                    </a>
                    <a href="http://t.me/HunterStrix07" target="_blank" aria-label="Telegram" class="social-icon telegram">
                        <i class="fab fa-telegram-plane"></i>
                    </a>
<!--                     <a href="YOUR_YOUTUBE_CHANNEL_LINK" target="_blank" aria-label="YouTube" class="social-icon youtube">
                        <i class="fab fa-youtube"></i>
                    </a> -->
                </div>

                <div class="footer-copyright-row">
                    <p>Copyright &copy; <?php echo date('Y'); ?> &middot; <?php bloginfo('name'); ?>. All the Logos, Trademarks and Images belong to their Respective Owners.</p>
                </div>
            </div>
            </div> </div> </footer>

<?php wp_footer(); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const openBtn = document.getElementById('security-report-btn');
    const closeBtn = document.getElementById('close-popup');
    const popup = document.getElementById('security-popup');

    if (openBtn) {
        openBtn.addEventListener('click', function() {
            if (popup) {
                popup.style.display = 'flex';
            }
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            if (popup) {
                popup.style.display = 'none';
            }
        });
    }
    
    if (popup) {
        popup.addEventListener('click', function(event) {
            if (event.target === popup) {
                popup.style.display = 'none';
            }
        });
    }
});
</script>

</body>
</html>
