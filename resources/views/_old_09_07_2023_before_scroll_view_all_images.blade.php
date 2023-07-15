@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <h4 class="home_title" style="padding-left: 40%;">All Photo Gallery <a class="btn btn-primary" href="{{ route('home') }}"><i class="fa fa-user"></i>Back</a></h4>
        <br>
        <br>
        

        <div class="row justify-content-center">
            <?php
            // $files = Storage::files(public_path('uploads/' . $user_profiles->folder_name));
            // print_r($files);die;

            // $folder_path = public_path('uploads/' . $user_profiles->folder_name) . '/*';
            // echo public_path('uploads/' );die;
            $gfg_folderpath = public_path('uploads/');
            if (is_dir($gfg_folderpath)) {
                        // GETTING INTO DIRECTORY
                        $files = opendir($gfg_folderpath); {
                            // CHECKING FOR SMOOTH OPENING OF DIRECTORY
                            if ($files) {
                                //READING NAMES OF EACH ELEMENT INSIDE THE DIRECTORY
                                while (($gfg_subfolder = readdir($files)) !== FALSE) {

                                    // CHECKING FOR FILENAME ERRORS
                                    if ($gfg_subfolder != '.' && $gfg_subfolder != '..') {
                                        //  echo $this->db->last_query();die;
                                        //  print_r($car_Details);die;
                                            $dirpath =  public_path('uploads/'. $gfg_subfolder);
                                            // GETTING INSIDE EACH SUBFOLDERS
                                            if (is_dir($dirpath)) {
                                                $file = opendir($dirpath); {
                                                    if ($file) {
                                                        //READING NAMES OF EACH FILE INSIDE SUBFOLDERS
                                                        while (($gfg_filename = readdir($file)) !== FALSE) {
                                                            if ($gfg_filename != '.' && $gfg_filename != '..') {
                                                                ?>
                                                                 <div class="col-sm-2">
                                                                    <div class="card card-dark card-profile">
                                                                        <div class="card-body">
                                                                            <a data-fancybox="gallery_<?php echo 'All'; ?>" href="{{ str_replace(public_path(), '', $dirpath . '/' . $gfg_filename )}}">
                                                                                <img src="{{ str_replace(public_path(), '', $dirpath . '/' . $gfg_filename )}}" style="height: 100%;width:100%;">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                // echo $dirpath . '/' . $gfg_filename .'<br>';
                                                                // $ext = pathinfo($dirpath . '/' . $gfg_filename, PATHINFO_EXTENSION);
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                       
                                    }
                                }
                            }
                        }
                    }
            ?>

           
        </div>
    </div>
@endsection
