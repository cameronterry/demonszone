<?php
defined( 'ABSPATH' ) or die();

require_once( DZ_INC . '/admin/artist.php' );
require_once( DZ_INC . '/admin/columns.php' );
require_once( DZ_INC . '/admin/fields.php' );

function dz_edit_term_field_text( $label, $meta_key, $term_id ) {
    $value = get_term_meta( $term_id, $meta_key, true ); ?>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="twitter_url"><?php esc_html_e( $label ); ?></label>
        </th>
        <td>
            <input type="text" id="<?php esc_attr_e( $meta_key ); ?>" name="<?php esc_attr_e( $meta_key ); ?>" value="<?php esc_attr_e( $value ); ?>" />
        </td>
    </tr>
<?php }
