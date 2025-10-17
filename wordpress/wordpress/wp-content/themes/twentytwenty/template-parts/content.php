<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

$class = '';
if ( !is_single() ) {
    $class = 'danh-sach';
}
?>

<div class="post-row" style="display:flex;flex-wrap:wrap;gap:24px;">
<article <?php post_class($class); ?> id="post-<?php the_ID(); ?>" style="width:100%;max-width:700px;margin:0 0 24px 32px;">
    <?php if ( !is_single() ) : ?>
    <a href="<?php the_permalink(); ?>" style="text-decoration:none; color:inherit; display:block;">
    <?php endif; ?>
        <div class="post-list-item" style="display:flex;align-items:stretch;background:#fff;border:1px solid #e5e5e5;border-radius:6px;overflow:hidden;padding:0;">
            <!-- Ngày bên trái -->
            <div style="width:80px;flex-shrink:0;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:16px 0;">
                <div style="font-size:36px;font-weight:bold;color:#1a237e;line-height:1;">
                    <?php echo get_the_date('d'); ?>
                </div>
                <div style="font-size:14px;text-transform:uppercase;color:#757575;">
                    THÁNG <?php echo get_the_date('m'); ?>
                </div>
            </div>
            <!-- Đường kẻ dọc -->
            <div style="width:1px;background:#e0e0e0;margin:0 16px;"></div>
            <!-- Nội dung bên phải -->
            <div class="post-content" style="flex:1;padding:16px 0;">
                <h3 style="font-size:18px;font-weight:bold;margin-bottom:8px;white-space:normal;">
                    <?php the_title(); ?>
                </h3>
                <div style="font-size:16px;color:#333;">
                    <?php
                    if ( is_search() || !is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) {
                        the_excerpt();
                    } else {
                        if ( is_single() ) {
                            the_content( __('Continue reading', 'twentytwenty') );
                        } else {
                            $post = get_post();
                            echo wp_trim_words( $post->post_content, 40, '...' );
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php if ( !is_single() ) : ?>
    </a>
    <?php endif; ?>

    <?php
    // Phần meta, phân trang, chỉnh sửa, tác giả, comment giữ nguyên như cũ
    ?>
    <div class="section-inner">
        <?php
        wp_link_pages(
            array(
                'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'twentytwenty' ) . '"><span class="label">' . __( 'Pages:', 'twentytwenty' ) . '</span>',
                'after'       => '</nav>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            )
        );

        

        twentytwenty_the_post_meta( get_the_ID(), 'single-bottom' );

        if ( post_type_supports( get_post_type( get_the_ID() ), 'author' ) && is_single() ) {
            get_template_part( 'template-parts/entry-author-bio' );
        }
        ?>
    </div><!-- .section-inner -->

    <?php
    if ( is_single() ) {
        get_template_part( 'template-parts/navigation' );
    }

    if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
        ?>
        <div class="comments-wrapper section-inner">
            <?php comments_template(); ?>
        </div><!-- .comments-wrapper -->
        <?php
    }
    ?>
</article><!-- .post -->
</div>
