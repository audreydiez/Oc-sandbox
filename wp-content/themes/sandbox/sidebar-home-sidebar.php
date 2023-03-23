<!-- renvoie un booléen si pas de widgets -->
<?php if (is_active_sidebar('sidebar')) : ?>
    <?php if (!dynamic_sidebar('home-sidebar')) : ?>
        <div class="widget">
            <h3 class="widget-title">Archives</h3>
            <div class="widget-content">
                <?php wp_get_archives(['type' => 'monthly']); ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>