<div class="air-pop-up" data-pop-up-id="<?php echo esc_html( $pop_up['guid'] ) ?>">
  <div class="pop-up-overlay pop-up-close"></div>
    <div class="pop-up-content" role="dialog" aria-labelledby="pop-up-heading-<?php echo esc_html( $pop_up['guid'] ) ?>">
      <button type="button" class="pop-up-close button-pop-up-close">
        <span class="screen-reader-text">
          <?php echo esc_html( 'Sulje' ) ?>
        </span>
        <?php include plugin_dir_path( __FILE__ ) . '../assets/pop-up-close.svg'; ?>
      </button>
      <h2 id="pop-up-heading-<?php echo esc_html( $pop_up['guid'] ) ?>">
        <?php echo esc_html( $pop_up['title'] ); ?>
      </h2>

      <?php echo wp_kses_post( wpautop( $pop_up['content'] ) ) ?>
    </div>
  </div>
</div>
