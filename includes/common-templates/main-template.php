<?php

// Prevent direct access to the plugin file
defined('ABSPATH') || exit;


/** 
 * 
 * Loader Button
 * 
 */
function loader_btn($class = '')
{
    ob_start();
?>
    <!-- centerv1 -->
    <button class="inline-flex items-center gap-3 rounded-md bg-primary px-5 py-3 text-white <?php echo esc_attr($class); ?>">
        <span class="animate-spin">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <mask id="path-1-inside-1_1881_16183" fill="white">
                    <path d="M15.328 23.5293C17.8047 22.8144 19.9853 21.321 21.547 19.2701C23.1087 17.2193 23.9686 14.72 23.9992 12.1424C24.0297 9.56481 23.2295 7.04587 21.7169 4.95853C20.2043 2.8712 18.0597 1.32643 15.6007 0.552947C13.1417 -0.220538 10.499 -0.181621 8.0638 0.663935C5.62864 1.50949 3.53049 3.11674 2.07999 5.24771C0.629495 7.37868 -0.096238 9.92009 0.0102418 12.4957C0.116722 15.0713 1.04975 17.5441 2.6712 19.5481L4.96712 17.6904C3.74474 16.1796 3.04133 14.3154 2.96106 12.3737C2.88079 10.432 3.42791 8.51604 4.52142 6.90953C5.61493 5.30301 7.19671 4.09133 9.03255 3.45387C10.8684 2.81642 12.8607 2.78708 14.7145 3.3702C16.5683 3.95332 18.1851 5.1179 19.3254 6.69152C20.4658 8.26514 21.0691 10.1641 21.046 12.1074C21.023 14.0506 20.3748 15.9347 19.1974 17.4809C18.02 19.027 16.3761 20.1528 14.5089 20.6918L15.328 23.5293Z"></path>
                </mask>
                <path d="M15.328 23.5293C17.8047 22.8144 19.9853 21.321 21.547 19.2701C23.1087 17.2193 23.9686 14.72 23.9992 12.1424C24.0297 9.56481 23.2295 7.04587 21.7169 4.95853C20.2043 2.8712 18.0597 1.32643 15.6007 0.552947C13.1417 -0.220538 10.499 -0.181621 8.0638 0.663935C5.62864 1.50949 3.53049 3.11674 2.07999 5.24771C0.629495 7.37868 -0.096238 9.92009 0.0102418 12.4957C0.116722 15.0713 1.04975 17.5441 2.6712 19.5481L4.96712 17.6904C3.74474 16.1796 3.04133 14.3154 2.96106 12.3737C2.88079 10.432 3.42791 8.51604 4.52142 6.90953C5.61493 5.30301 7.19671 4.09133 9.03255 3.45387C10.8684 2.81642 12.8607 2.78708 14.7145 3.3702C16.5683 3.95332 18.1851 5.1179 19.3254 6.69152C20.4658 8.26514 21.0691 10.1641 21.046 12.1074C21.023 14.0506 20.3748 15.9347 19.1974 17.4809C18.02 19.027 16.3761 20.1528 14.5089 20.6918L15.328 23.5293Z" stroke="white" stroke-width="14" mask="url(#path-1-inside-1_1881_16183)"></path>
            </svg>
        </span>

        Loading...
    </button>
<?php
    return ob_get_clean();
}

/** 
 * 
 * spinner
 * 
 */
function spinnerv1($class = '')
{
    ob_start();
?>
    <div class="animatespinv1">
        <div class="animate-spin <?php echo esc_attr($class); ?>">
            <svg width="20" height="20" viewBox="0 0 49 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                <mask id="path-1-inside-1_1881_16179" fill="white">
                    <path d="M18.5503 49.3989C23.2997 50.4597 28.2554 50.1113 32.8097 48.3965C37.364 46.6816 41.3187 43.6748 44.1889 39.7449C47.0591 35.815 48.7199 31.1328 48.9676 26.2727C49.2153 21.4125 48.0392 16.5858 45.5834 12.3844C43.1277 8.18304 39.4991 4.78974 35.1428 2.62071C30.7865 0.451685 25.8918 -0.398759 21.0592 0.173693C16.2265 0.746144 11.666 2.7166 7.93703 5.84338C4.20803 8.97015 1.47267 13.1173 0.0664691 17.7761L5.29059 19.353C6.38986 15.711 8.52815 12.4691 11.4432 10.0248C14.3582 7.58057 17.9233 6.04021 21.7011 5.59272C25.4789 5.14522 29.3052 5.81003 32.7106 7.50561C36.116 9.20119 38.9526 11.8538 40.8723 15.1381C42.792 18.4224 43.7114 22.1956 43.5178 25.9949C43.3241 29.7942 42.0258 33.4543 39.7822 36.5264C37.5385 39.5986 34.4469 41.949 30.8868 43.2896C27.3266 44.6302 23.4525 44.9025 19.7398 44.0732L18.5503 49.3989Z"></path>
                </mask>
                <path d="M18.5503 49.3989C23.2997 50.4597 28.2554 50.1113 32.8097 48.3965C37.364 46.6816 41.3187 43.6748 44.1889 39.7449C47.0591 35.815 48.7199 31.1328 48.9676 26.2727C49.2153 21.4125 48.0392 16.5858 45.5834 12.3844C43.1277 8.18304 39.4991 4.78974 35.1428 2.62071C30.7865 0.451685 25.8918 -0.398759 21.0592 0.173693C16.2265 0.746144 11.666 2.7166 7.93703 5.84338C4.20803 8.97015 1.47267 13.1173 0.0664691 17.7761L5.29059 19.353C6.38986 15.711 8.52815 12.4691 11.4432 10.0248C14.3582 7.58057 17.9233 6.04021 21.7011 5.59272C25.4789 5.14522 29.3052 5.81003 32.7106 7.50561C36.116 9.20119 38.9526 11.8538 40.8723 15.1381C42.792 18.4224 43.7114 22.1956 43.5178 25.9949C43.3241 29.7942 42.0258 33.4543 39.7822 36.5264C37.5385 39.5986 34.4469 41.949 30.8868 43.2896C27.3266 44.6302 23.4525 44.9025 19.7398 44.0732L18.5503 49.3989Z" stroke="#3C50E0" stroke-width="14" mask="url(#path-1-inside-1_1881_16179)"></path>
            </svg>
        </div>
    </div>
<?php
    return ob_get_clean();
}


/** 
 * 
 * Input v1
 * 
 */
function inputv1($label = '', $name = '', $type = '', $placeholder = '', $required = false, $class = '')
{
?>
    <label for="<?php echo esc_attr($name); ?>" class="mb-3 block text-sm font-medium text-black dark:text-white">
        <?php echo wp_kses_post($label); ?>
    </label>
    <input type="<?php echo esc_attr($type); ?>" id="<?php echo esc_attr($name); ?>" name="<?php echo esc_attr($name); ?>" placeholder="<?php echo esc_attr($placeholder); ?>" class="<?php echo esc_attr($class); ?> w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" <?php echo esc_attr($required ? 'required' : ''); ?>>
<?php
}

/** 
 * 
 * Select v1
 * 
 */
function selectv1($label = '', $name = '', $defaultText = '', $required = false, $class = '', $options = [])
{
?>
    <label id="<?php echo esc_attr($name); ?>" class="mb-3 block text-sm font-medium text-black dark:text-white">
        <?php echo wp_kses_post($label); ?>
    </label>
    <select name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($name); ?>" <?php echo esc_attr($required ? 'required' : ''); ?> class="<?php echo esc_attr($class); ?> w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">
        <option value=""><?php echo wp_kses_post($defaultText); ?></option>
        <?php
        if (!empty($options)) :
            foreach ($options as $key => $item):
                $title = $item['title'];
                $value = $item['value'];
                $quantity = $item['quantity'];
                if ($quantity <= 0) {
                    continue;
                }
        ?>
                <option value="<?php echo esc_attr($value); ?>" data-quantity="<?php echo esc_attr($quantity); ?>"><?php echo wp_kses_post($title); ?></option>
        <?php
            endforeach;
        endif;
        ?>
    </select>
<?php
}

/** 
 * 
 * query_items
 * 
 */
function query_items($post_type = '')
{
    $items = [];
    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => -1,
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $items[] = [
                'title' => get_the_title(),
                'value' => get_the_ID(),
                'quantity' => get_field('quantity'),
            ];
        }
        wp_reset_postdata();
        return $items;
    }
    return false;
}
