<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="manifest" href="/manifest.json">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header>
        <div class="header-container">
            <div class="site-title">
                <a href="<?php echo esc_url(home_url('/')); ?>"><strong><?php bloginfo('name'); ?></strong></a>
            </div>

            <nav class="main-navigation">
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                    <li><a href="<?php echo esc_url( get_category_link( get_cat_ID( 'Apps' ) ) ); ?>">Apps</a></li>
                    <li><a href="<?php echo esc_url( get_category_link( get_cat_ID( 'Games' ) ) ); ?>">Games</a></li>
                </ul>
            </nav>

            <div class="header-right">
                <div class="search-container">
                    <button id="search-popup-btn" class="search-popup-toggle" aria-label="Open Search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg>
                    </button>
                </div>
                <span class="menu-toggle">
                    <svg id="menu-btn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 960 960" fill="#5f6368" onclick="toggleSidebar()" role="button" aria-label="Menu Button">
                        <path d="M120 720v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/>
                    </svg>
                </span>
            </div>
        </div>
        
        <script>
        // === SEARCH POPUP KA ZAROORI JAVASCRIPT ===
        document.addEventListener('DOMContentLoaded', function() {
            const searchButton = document.getElementById('search-popup-btn');
            const searchOverlay = document.querySelector('.search-overlay');
            const searchPopupForm = document.querySelector('.search-popup-form');

            function openSearch() {
                document.body.classList.add('search-modal-open');
                if (searchPopupForm) {
                    const searchInput = searchPopupForm.querySelector('.header-search-input');
                    if (searchInput) {
                        searchInput.focus();
                    }
                }
            }

            function closeSearch() {
                document.body.classList.remove('search-modal-open');
            }

            if (searchButton) {
                searchButton.addEventListener('click', function(event) {
                    event.stopPropagation();
                    openSearch();
                });
            }

            if (searchOverlay) {
                searchOverlay.addEventListener('click', closeSearch);
            }

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && document.body.classList.contains('search-modal-open')) {
                    closeSearch();
                }
            });
        });
        </script>
    </header>

    <div class="search-overlay"></div>
    <div class="search-popup-form">
        <form role="search" method="get" class="header-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="search" class="header-search-input" placeholder="Search &hellip;" value="<?php echo get_search_query(); ?>" name="s" />
            <button type="submit" class="header-search-submit" aria-label="Search">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg>
            </button>
        </form>
    </div>

    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>
    <div id="sidebar" class="sidebar">
        <div class="sidebar-nav">
            <ul>
                <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                <li><a href="<?php echo esc_url( get_category_link( get_cat_ID( 'Apps' ) ) ); ?>">Apps</a></li>
                <li><a href="<?php echo esc_url( get_category_link( get_cat_ID( 'Games' ) ) ); ?>">Games</a></li>
            </ul>
        </div>
    </div>
    
    <main>
