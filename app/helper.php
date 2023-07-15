<?php

function add_edit_form() {
    echo '<div id="add_edit_form" style="display: none;"><div id="display_update_form"></div></div>';
}

function get_chkbox_row($row,$temp_row_id){

    $selected = "";
    if ($row->id > 0 && !empty($temp_row_id)) {
        $selected_row_id = explode(",", $temp_row_id);
        if (in_array($row->id, $selected_row_id)) {
            $selected = 'checked="checked"';
        }
    }
    return '<input type="checkbox" name="table_chk[]" class="row_id_chk" id="row_chk_id_'.$row->id.'" value="'.$row->id.'" '.$selected.'/>';

}

function currency_rates($source = 'INR',$currencies = 'USD,EUR'){
    $curl = curl_init();
    //old key "apikey: lEokZof1kbz59j4y6bl344UKFfjclGVO"
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.apilayer.com/currency_data/live?source=$source&currencies=$currencies",
    CURLOPT_HTTPHEADER => array(
        "Content-Type: text/plain",
        "apikey: IMQndlX1D9Y3OTgOAEtc3DRkWOxMburr"
    ),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET"
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}