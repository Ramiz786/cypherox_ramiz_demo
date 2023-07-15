<?php
if(!empty($images)){
    foreach($images as $single_image){

?>
{{-- <div class="row justify-content-center"> --}}
<div class="col-sm-2">
    <div class="card card-dark card-profile">
        <div class="card-body">
            <a data-fancybox="gallery_<?php echo 'All'; ?>" href="{{ str_replace(public_path(), '', $single_image) }}">
                <img src="{{ str_replace(public_path(), '', $single_image) }}" style="height: 100%;width:100%;">
            </a>
        </div>
    </div>
</div>
{{-- </div> --}}
<?php
    }
}
?>
