<?php
// Retrieve custom fields
$version = esc_html(get_post_meta(get_the_ID(), '_apkversion', true));
$developer = esc_html(get_post_meta(get_the_ID(), '_apkdeveloper', true));
$playlink = esc_html(get_post_meta(get_the_ID(), '_apkgoogleplay', true));
$pkg = esc_html(get_post_meta(get_the_ID(), '_apkpackagename', true));
$apksize = esc_html(get_post_meta(get_the_ID(), '_apksize', true));
$apkcategory = esc_html(get_post_meta(get_the_ID(), '_apkcategory', true));

$categories = get_the_category();
$categorylink = ''; // Initialize the variable to hold category links

if ( ! empty( $categories ) ) {
	foreach ( $categories as $category ) {
		$categorylink .= '<a href="' . get_category_link( $category->term_id ) . '" class="category-link">' . esc_html( $category->name ) . '</a> ';
	}
}

// Get the custom fields for the current post
$custom_fields = get_post_meta(get_the_ID(), '_custom_fields', true);

// Initialize an empty variable for the custom size
$custom_size = '';

// Check if custom fields exist
if (!empty($custom_fields)) {
	foreach ($custom_fields as $field) {
		$custom_size = esc_html($field['size']);
		$filelink = esc_html($field['link']);
	}
}

// If $custom_size is empty, assign it to $apksize
if (empty($custom_size)) {
    if (stripos($apksize, 'Varies with device') === false) {
        $custom_size = "($apksize)"; // Show size in brackets if valid
    } else {
        $custom_size = ''; // Keep it empty if it contains "Varies with device"
    }
}

$date = get_the_date();
$short_info = get_post_meta(get_the_ID(), '_app_short_description', true);
// If short description is empty, extract the first paragraph from the content
if ( empty( $short_info ) ) {
    $content = get_the_content();
    $content = apply_filters( 'the_content', $content );

    if ( preg_match( '/<p>(.*?)<\/p>/', $content, $matches ) ) {
        $info = $matches[1]; // Extract only the text inside the first <p>...</p>
    } else {
        $info = ''; // Fallback if no paragraph is found
    }
} else {
    $info = $short_info; // Use the meta value if available
}

$important_note = get_post_meta(get_the_ID(), '_important_note', true);
?>
<section>
	<div class="app-details">
		<div class="left-side">
			<div class="icon">
				<?php
				$thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
				if ($thumb) : ?>
				<img class="lazy" data-src="<?php echo esc_url($thumb[0]); ?>"
					 src="https://howtoinfo.xyz/wp-content/uploads/2025/06/loading.gif" alt="<?php the_title_attribute(); ?> icon">
				<?php endif; ?>
			</div>
			<div class="single-app-meta">
				<h2 class="title"><?php the_title(); ?><span class="apktype">APK</span></h2>
				<div class="app-meta">
					<span class="genre"><?php echo $categorylink; ?></span>
					<span class="version"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="m280-80 160-300-320-40 480-460h80L520-580l320 40L360-80h-80Z"/></svg><?php echo $version; ?></span>
					<span class="last-update"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="M480-120q-138 0-240.5-91.5T122-440h82q14 104 92.5 172T480-200q117 0 198.5-81.5T760-480q0-117-81.5-198.5T480-760q-69 0-129 32t-101 88h110v80H120v-240h80v94q51-64 124.5-99T480-840q75 0 140.5 28.5t114 77q48.5 48.5 77 114T840-480q0 75-28.5 140.5t-77 114q-48.5 48.5-114 77T480-120Zm112-192L440-464v-216h80v184l128 128-56 56Z"/></svg><?php echo $date; ?></span>
				</div>
			</div>
		</div>
		<div class="right-side">
            <div class="buttons">
                <a href="?download=links" class="download-btn disabled" id="downloadBtn">
                    <div class="button-left">
                        <div class="button-top">Download APK<span class="filesize"><?php echo $custom_size; ?></span></div>
                        <div class="button-bottom"><span class="for-android">for Android</span></div>
                    </div>
                    <div class="button-right" id="buttonIcon">
                        <div class="loader"></div>
                    </div>
                </a>

                <?php
                // TRUSTED BADGE CODE
                $sha256 = get_field('sha256_hash');
                $sha1 = get_field('sha1_hash');

                if ($sha256 || $sha1):
                ?>
                <button id="security-report-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    Trusted
                </button>
                <?php endif; ?>
            </div>

            <script>
            window.addEventListener('load', function () {
              const btn = document.getElementById('downloadBtn');
              const iconContainer = document.getElementById('buttonIcon');

              setTimeout(() => {
                btn.classList.remove('disabled');
                iconContainer.innerHTML = `
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#ffffff">
                    <path d="M480-320 280-520l56-58 104 104v-326h80v326l104-104 56 58-200 200ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z"/>
                  </svg>
                `;
              }, 3000);
            });
            </script>
		</div>
	</div>
	<div class="short-info"><?php echo $short_info; ?></div>
	<?php
    if (!empty($important_note)) {
        echo '<div class="important-note">' . esc_html($important_note) . '</div>';
    } ?>
</section>

<?php
// SECURITY POPUP CODE - UPDATED WITH APP INFO
if (isset($sha256) && ($sha256 || (isset($sha1) && $sha1))):
?>
<div id="security-popup" class="popup-overlay">
    <div class="popup-content">
        <button id="close-popup" class="popup-close">&times;</button>

        <div class="popup-app-header">
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="popup-app-icon">
                    <?php the_post_thumbnail('thumbnail'); // Thumbnail size (usually 150x150) ?>
                </div>
            <?php endif; ?>
            <div class="popup-app-info">
                <h3 class="popup-app-title"><?php the_title(); ?></h3>
                <?php 
                    // Yeh $version variable aapki file mein pehle se mojood hai
                    if ( ! empty( $version ) ) : 
                ?>
                    <span class="popup-app-version">Version: <?php echo $version; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <h4 class="security-report-heading">Security Report</h4>
        <p>This app has passed our security checks. Please verify the hashes below to ensure you have the correct file.</p>

        <?php if ($sha256): ?>
            <div class="hash-info">
                <strong>SHA256:</strong>
                <code><?php echo esc_html($sha256); ?></code>
            </div>
        <?php endif; ?>

        <?php if ($sha1): ?>
            <div class="hash-info">
                <strong>SHA1:</strong>
                <code><?php echo esc_html($sha1); ?></code>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<section>
	<h2 class="section-title">DESCRIPTION</h2>
    <div class="app-description" style="position: relative;">
        <div id="full-description">
            <?php echo get_the_content(); ?>
        </div>
    </div>
	<div class="keys">
		<span class="category" title="This app's genre!"><?php echo $apkcategory; ?></span>
		<span class="device" title="Available for Android!">Android</span>
		<span class="type" title="APK File of app is available!">App APK</span>
		<span class="is-safe" onclick="openPopup()" title="This app is scanned and marked safe!">Safe File</span>
	</div>
</section>
<section class="faq-section">
    <h2 class="section-title">FAQs about <?php the_title(); ?></h2>
    <div class="faq-container">
        <div class="faq-item">
            <button class="faq-question">What is <?php the_title(); ?>?</button>
            <div class="faq-answer">
                <p><?php echo esc_html($info); ?></p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">Is <?php the_title(); ?> safe to download?</button>
            <div class="faq-answer">
                <p>Yes, <?php the_title(); ?> has been scanned and verified by our team for safety before being uploaded.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">Which version of <?php the_title(); ?> is available here?</button>
            <div class="faq-answer">
                <p>The latest version available is <?php echo esc_html($version); ?>.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">How can I download <?php the_title(); ?>?</button>
            <div class="faq-answer">
                <p>Clicking download button will open <a href="?download=links" >Download page for <?php the_title(); ?></a>, there you download latest version or old version APK file easily.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">Which device is compatible with <?php the_title(); ?>?</button>
            <div class="faq-answer">
                <p>You can install <?php the_title(); ?> on Android, it works on all modern devices!</p>
            </div>
        </div>
    </div>
</section>
<script>
document.querySelectorAll('.faq-question').forEach(button => {
    button.addEventListener('click', function () {
        const faqItem = this.parentElement;
        faqItem.classList.toggle('open');
    });
});
</script>
<section>
	<h2 class="section-title">APP INFORMATION</h2>
	<div class="package-details">
		<div class="item">
			<div class="label"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="M480-400 40-640l440-240 440 240-440 240Zm0 160L63-467l84-46 333 182 333-182 84 46-417 227Zm0 160L63-307l84-46 333 182 333-182 84 46L480-80Zm0-411 273-149-273-149-273 149 273 149Zm0-149Z"/></svg>Version</div>
			<div class="value"><?php echo $version; ?></div>
		</div>
		<div class="item">
			<div class="label"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="M480-120q-75 0-140.5-28.5t-114-77q-48.5-48.5-77-114T120-480q0-75 28.5-140.5t77-114q48.5-48.5 114-77T480-840q82 0 155.5 35T760-706v-94h80v240H600v-80h110q-41-56-101-88t-129-32q-117 0-198.5 81.5T200-480q0 117 81.5 198.5T480-200q105 0 183.5-68T756-440h82q-15 137-117.5 228.5T480-120Zm112-192L440-464v-216h80v184l128 128-56 56Z"/></svg>Update</div>
			<div class="value"><?php echo $date; ?></div>
		</div>
		<div class="item">
			<div class="label"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z"/></svg>Developer</div>
			<div class="value"><?php echo $developer; ?></div>
		</div>
		<div class="item">
			<div class="label"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="m260-520 220-360 220 360H260ZM700-80q-75 0-127.5-52.5T520-260q0-75 52.5-127.5T700-440q75 0 127.5 52.5T880-260q0 75-52.5 127.5T700-80Zm-580-20v-320h320v320H120Zm580-60q42 0 71-29t29-71q0-42-29-71t-71-29q-42 0-71 29t-29 71q0 42 29 71t71 29Zm-500-20h160v-160H200v160Zm202-420h156l-78-126-78 126Zm78 0ZM360-340Zm340 80Z"/></svg>Category</div>
			<div class="value"><?php echo $categorylink; ?>
			</div>
		</div>
		<div class="item">
			<div class="label"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="M840-680v480q0 33-23.5 56.5T760-120H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h480l160 160Zm-80 34L646-760H200v560h560v-446ZM480-240q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35ZM240-560h360v-160H240v160Zm-40-86v446-560 114Z"/></svg>File Size</div>
			<div class="value"><?php echo $custom_size; ?>
			</div>
		</div>
		<div class="item">
			<div class="label"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="m380-240 280-180-280-180v360ZM160-120q-33 0-56.5-23.5T80-200v-520h240v-80q0-33 23.5-56.5T400-880h160q33 0 56.5 23.5T640-800v80h240v520q0 33-23.5 56.5T800-120H160Zm0-80h640v-440H160v440Zm240-520h160v-80H400v80ZM160-200v-440 440Z"/></svg>Package Name</div>
			<div class="value"><?php echo $pkg; ?></div>
		</div>
	</div>
</section>

<?php
// Assuming you are using WordPress and ACF (Advanced Custom Fields)
// Get the value of the custom field "screenshots"
$screenshots = esc_html(get_post_meta(get_the_ID(), '_apkscreenshots', true));

// Check if the custom field has any value (comma-separated URLs)
if ($screenshots) {
	// Convert the comma-separated URLs into an array
	$screenshot_urls = explode(',', $screenshots);
?>
<section class="content-item">
	<h2 class="section-title">
		SCREENSHOTS
	</h2>
	<div class="screenshotsbox" id="screenshots">
		<div class="screenshots">
			<?php
	// Loop through the array of image URLs and display them as images
	foreach ($screenshot_urls as $url) {
		// Trim any extra spaces in the URLs
		$url = trim($url);
			?>
			<img class="lazy screenshot-image" data-src="<?php echo esc_attr($url); ?>"
				 src="https://howtoinfo.xyz/wp-content/uploads/2025/06/loading.gif"
				 data-full="<?php echo esc_attr($url); ?>"
				 onclick="openLightbox(this)" alt="<?php the_title(); ?> screenshot">
			<?php
	}
			?>
		</div>
	</div>
</section>
<div id="lightbox" class="lightbox" onclick="closeLightbox()">
	<img id="lightbox-img" src="" alt="Preview">
</div>
<?php
}
?>

<div class="popoverlay" id="popoverlay" onclick="closePopup()"></div>

<div class="popup" id="popup">
	<div class="popup-header">
		<span class="popup-title">APK File Security</span>
		<button class="close-btn" onclick="closePopup()">X</button>
	</div>
	<div class="popup-content">
		<p>This apk file of <code><?php the_title(); ?></code> is scanned by howtoinfo.xyz TEAM. Our team uses the app for few hours and test it, if the APK file is safe and secure then we upload it to site.</p>
		<p><a href="https://howtoinfo.xyz/contact-us/">Report an issue!</a></p>
	</div>
</div>
