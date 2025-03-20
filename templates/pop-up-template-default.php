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

      <?php echo wp_kses_post( wpautop( $pop_up['content'] ) ); ?>

      <?php if ( $pop_up['link'] && ! empty( $pop_up['link']['url'] ) ) : ?>
        <p class="pop-up-link-wrapper">
          <a href="<?php echo esc_url( $pop_up['link']['url'] ) ?>" class="button-pop-up-link">
            <?php echo esc_html( $pop_up['link']['title'] ) ?>
          </a>
        </p>
      <?php endif; ?>

      <?php if ( $pop_up['yes_no'] ) : ?>
        <div class="pop-up-yes-no-wrapper">
          <button class="air-pop-up-button button-pop-up-yes">
            <?php echo esc_html( $pop_up['yes_no']['label_yes'] ) ?>
          </button>
          <button class="air-pop-up-button button-pop-up-no">
            <?php echo esc_html( $pop_up['yes_no']['label_no'] ) ?>
          </button>
        </div>
      <?php endif; ?>

    </div>
  </div>
</div>
