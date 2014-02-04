<div class="wrap"> 
    <h2>ZBookingCalendar</h2> 
    <form method="post" action="options.php"> 
        <?php @settings_fields('zbc-group'); ?> 
        <?php @do_settings_fields('zbc-group'); ?> 
        
        <table class="form-table"> 
            <tr valign="top"> 
                <th scope="row">
                    <label for="setting1">Setting 1</label>
                </th> 
                <td>
                    <input type="text" name="setting1" id="setting1" 
                           value="<?php echo get_option('setting1'); ?>" />
                </td> 
            </tr> 
            <tr valign="top"> 
                <th scope="row">
                    <label for="setting2">Setting 2</label>
                </th> 
                <td>
                    <input type="text" name="setting2" id="setting2" 
                           value="<?php echo get_option('setting2'); ?>" />
                </td> 
            </tr> 
        </table> 
            
       <?php @submit_button(); ?> 
    </form> 
</div>