@extends('backend.layouts.app')
<style>

    table {
        border-spacing: 0;
    }
    table thead tr,
    table thead tr th{
        background: #25bcf1;
        border: 1px solid #d6f5d6;
        background-clip: content-box;
    }

    table thead tr th{
        border: none;
        background-clip: content-box;
    }

    .modal-xls {
        max-width: 90% !important;
    }

    .modal-mediumlg {
        max-width: 40% !important;
    }


    .radio-button input[type="radio"] {
        display: none;
    }

    .radio-button label {
        display: inline-block;
        background-color: #d1d1d1;
        /*padding: 4px 11px;*/
        font-size: 15px;
        cursor: pointer;
        border-radius: 1.2rem;
        padding: 0.6rem 1.2rem;
    }

    .radio-button input[type="radio"]:checked + label {
        background-color: #76cf9f;
    }

    #frm_cht .ch_tables {
    }

    #frm_cht .ch_tables label {
    }


    #table_selection {
        display: none;
    }

    .currently-loading {
        opacity: 0.75;
        -moz-opacity: 0.75;
        filter: alpha(opacity=75);
        background-image: url({{ static_asset('backup_restore_loading.gif') }});
        background-repeat: no-repeat;
        position: absolute;
        height: 100%;
        width: 100%;
        z-index: 10;
        /*left: 50%;*/
        /*top: 50%;*/
        /*display:block;*/
        background-size: contain;
        /*background-size: cover;*/

    }

    .mailresponse {
        width: 100%;
        text-align: center;
        padding: 0;
        margin: 0;
    }

    .mailresponse p {
        padding: 4px 10px;
        margin: 0;
    }

    /*section table shared link*/
    table tr th, table tr td {
        font-size: 1rem;
    }

    .container {
        padding: 20px;
    }

    .container h1 {
        font-size: 40px;
        color: #000;
        text-align: center;
        margin-bottom: 27px;
    }

    .row h2 {
        font-size: 20px;
        color: #444;
    }

    .head h5 {
        float: left;
        width: 75%;
        margin-bottom: 0;
        margin-top: 10px;
    }

    i.plus {
        -webkit-font-smoothing: antialiased;
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        line-height: 1;
        vertical-align: middle;
    }

    #userData a.btn {
        padding: .1rem .5rem;
    }

    .alert-danger p {
        margin-bottom: 2px;
    }


</style>


@section('content')
    @php
        //        session_start();
                        if ( !function_exists( 'getRows' ) ) {
                            function getRows(){
                        $share_path = base_path('databasebackups/share');
                        $jsonFile = $share_path . DIRECTORY_SEPARATOR .  'shares.json';

                                if(file_exists($jsonFile)){
                                    $jsonData = file_get_contents($jsonFile);
                                    $data = json_decode($jsonData, true);

                                    return !empty($data) ? $data : false;
                                }
                                return false;
                            }
                            }



                        if ( !function_exists( 'checkpassword' ) ) {
                        function checkpassword(Request $request, $param ) {

                        $postpass = filter_input(INPUT_POST, "dwnldpwdxx", FILTER_SANITIZE_SPECIAL_CHARS);
                        if ($postpass) {
                        $postpass = preg_replace('/\s+/', '', $postname);
                        $passa = false;
                        $passpass = false;
                        if (md5($postpass) === $param) {
                        $passa = true;
                        $passpass = true;
                        }
                        }
                        }
                        }

                        if ( !function_exists( 'mytemplatefunction' ) ) {
                        function mytemplatefunction( $param ) {
                        return $param . " World";
                        }
                        }

                        if ( !function_exists( 'checkTime' ) ) {
                        function checkTime($time, $lifedays = false)
                        {
                        $lifedays = $lifedays ? (int)$lifedays : 1;
                        $lifetime = 86400 * $lifedays;
                        if (time() <= $time + $lifetime) {
                        return true;
                        }
                        return false;
                        }
                        }

                if ( !function_exists( 'checkTimeBetween' ) ) {
          function checkTimeBetween($time, $lifedays = false)
           {
               $lifedays = $lifedays ? (int)$lifedays : 1;
               $lifetime = 86400 * $lifedays;
               if (time() >= $time && time() <= $time + $lifetime) {
                   return true;
               }
               return false;
           }
           }

                if ( !function_exists( 'checkTimeBiggerOrSmaler' ) ) {
          function checkTimeBiggerOrSmaler($time, $lifedays = false)
           {
               $lifedays = $lifedays ? (int)$lifedays : 1;
               $lifetime = 86400 * $lifedays;
               if (time() >= $time && time() <= $time + $lifetime) {
                   return 10;
               } elseif (time() < $time) {
                   return 0;
               } elseif (time() > $time + $lifetime) {
                   return 1;
               }

           }
           }


                 if ( !function_exists( 'secondsToWords' ) ) {
               function secondsToWords($seconds)
        {
            $days = intval(intval($seconds) / (3600*24));
            $hours = (intval($seconds) / 3600) % 24;
            $minutes = (intval($seconds) / 60) % 60;
            $seconds = intval($seconds) % 60;

        //    $days = $days ? $days . ' days' : '';
        //    $hours = $hours ? $hours . ' hours' : '';
        //    $minutes = $minutes ? $minutes . ' minutes' : '';
        //    $seconds = $seconds ? $seconds . ' seconds' : '';

        //    return $days . $hours . $minutes . $seconds;
            return $days . ' days & ' . $hours . ':' . $minutes . ':' . $seconds;
        }
        }



                        if ( !function_exists( 'mbPathinfo' ) ) {

                        /**
                        * Get pathinfo in UTF-8
                        *
                        * @param string $filepath to search
                        *
                        * @return array $ret
                        */
                        function mbPathinfo($filepath)
                        {
                        preg_match(
                        '%^(.*?)[\\\\/]*(([^/\\\\]*?)(\.([^\.\\\\/]+?)|))[\\\\/\.]*$%im',
                        $filepath,
                        $node
                        );

                        if (isset($node[1])) {
                        $ret['dirname'] = $node[1];
                        } else {
                        $ret['dirname'] = '';
                        }

                        if (isset($node[2])) {
                        $ret['basename'] = $node[2];
                        } else {
                        $ret['basename'] = '';
                        }

                        if (isset($node[3])) {
                        $ret['filename'] = $node[3];
                        } else {
                        $ret['filename'] = '';
                        }

                        if (isset($node[5])) {
                        $ret['extension'] = $node[5];
                        } else {
                        $ret['extension'] = '';
                        }
                        return $ret;
                        }
                        }

                        if ( !function_exists( 'getFileSize' ) ) {
                        /**
                        * Determine the size of a file
                        *
                        * @param string $path file to calculate
                        *
                        * @return sizeInBytes
                        * @since  3.0.3
                        */
                        function getFileSize($path)
                        {
                        $size = filesize($path);

                        if (!($file = fopen($path, 'rb'))) {
                        return false;
                        }
                        if ($size >= 0) { // Check if it really is a small file (< 2 GB)
                        if (fseek($file, 0, SEEK_END) === 0) { // It really is a small file
                        fclose($file);
                        return $size;
                        }
                        }
                        // Quickly jump the first 2 GB with fseek. After that fseek is not working on 32 bit php (it uses int internally)
                        $size = PHP_INT_MAX - 1;
                        if (fseek($file, $size) !== 0) {
                        fclose($file);
                        return false;
                        }
                        $length = 1024 * 1024;
                        while (!feof($file)) { // Read the file until end
                        $read = fread($file, $length);
                        $size = bcadd($size, $length);
                        }
                        $size = bcsub($size, $length);
                        $size = bcadd($size, strlen($read));

                        fclose($file);
                        return $size;
                        }
                        }


                        if ( !function_exists( 'formatSize' ) ) {
                        /**
                        * Format file size
                        *
                        * @param string $size new format
                        *
                        * @return formatted size
                        */
                        function formatSize($size)
                        {
                        $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');
                        $syz = $sizes[0];
                        for ($i = 1; (($i < count($sizes)) && ($size >= 1024)); $i++) {
                        $size = $size / 1024;
                        $syz  = $sizes[$i];
                        }
                        return round($size, 2).' '.$syz;
                        }
                        }

                        if ( !function_exists( 'formatSize2' ) ) {
                        /**
                        * Format file size
                        *
                        * @param string $size new format
                        *
                        * @return formatted size
                        */
                        function formatSize2($size)
                        {
                        $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');
                        $syz = $sizes[0];
                        for ($i = 1; (($i < count($sizes)) && ($size >= 1024)); $i++) {
                        $size = $size / 1024;
                        $syz  = $sizes[$i];
                        }
                        return round($size, 2);
                        }
                        }

                        if ( !function_exists( 'scanFolder' ) ) {
                        function scanFolder($path, $ignore_files = [])
                        {
                        try {
                        if (is_dir($path)) {
                        $data = array_diff(scandir($path), array_merge(['.', '..'], $ignore_files));
                        natsort($data);
                        return $data;
                        }
                        return [];
                        } catch (Exception $ex) {
                        return [];
                        }
                        }
                        }




    @endphp

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col">
                <div class="alert alert-info" role="alert">
                    <b style="font-size:17px">{{ translate('The backup and restore (DataBase, Folder:public/uploads, Addons And WebSite) and ability to share and send download links is made for you with love by Kia from Aryaclub.com') }}
                        &#128151</b>
                </div>

                <div class="alert alert-warning" role="alert">
                    <p style="font-size:14px">{{ translate('This is a complete backup and restore feature, it is a solution for you if your site and database has < 1GB data, can be used for quickly backup and restore your site.')}}</p>
                    <p style="font-size:14px">{{ translate('If you have more than 1GB files/database/addons, you should use backup feature of your hosting or VPS.')}}</p>
                    <p style="font-size:14px">{{ translate('It is a full backup, it is back up files/website/addons and your database.')}}</p>
                </div>

            </div>
        </div>
    </div>

    @php
        session_start();
        $logspath = base_path('databasebackups/log');
        //   $logspath = '_content/log/';
        $loglist = glob($logspath.'*.json');
        // set most recenton top
        $loglist = array_reverse($loglist);
        $available_days = array();

        foreach ($loglist as $day) {
        $path_parts = pathinfo($day);

        $filenamearr = explode("-", $path_parts['filename']);
        $cleanname = array();
        foreach ($filenamearr as $filenamepart) {
        $cleanname[] = ltrim($filenamepart, '0');
        }
        $available_days[] = $path_parts['filename'];
        }
        $load_datepicker_lang = false;
        $regional_picker = 'en';

//        //get shared link info
//        $members = getRows();
    @endphp

    {{--     //table selection for exclude from backup--}}
    <div class="card">
        @php
            $nr = count($tables);
            $cr = $nr / 5;
            $nr %$cr > 0 ? $cr++ :$cr;
            $db = "Tables_in_".env('DB_DATABASE');
            $i=0;
            $msg_select_all="Select All (%s tables)";
            $msg_select_allx="%s %s %s %s %s";

            $insert4 = "Please insert at least 4 chars, or leave blank to get a random password";
            $time = time();
            $salt = '57a3e3fc49b81ba5856dc89dcf389b08';
            $hash = md5($salt.$time);
            $pulito =  env('APP_URL');

            $sharelinkatts = array(
                'insert4' => $insert4,
                'time' => $time,
                'hash' => $hash,
                'pulito' => $pulito,
            );
            $share_lifetime = array(
                // "days" => "menu value"
                "1" => "24 h",
                "2" => "48 h",
                "3" => "72 h",
                "5" => "5 days",
                "7" => "7 days",
                "10" => "10 days",
                "30" => "30 days",
                "365" => "1 year",
                "36500" => "Unlimited",
                );
            $backup_type = array(
                "1" => "DataBase",
                "2" => "Folder",
                "4" => "Addons",
                "8" => "WebSite",
                );
            $lifetime = 1;
            $one_time_download = 0;
            $advance_download = 0;
            $AECmodals['share'] = $sharelinkatts;


        @endphp

        <div class="card-header">

            <label for="checkboxkia"
                   id="advcheck">{{ translate('Advanced selection for Tables, to exclude from Backup') }}
                <input onchange="show_hide_selection(this)" type="checkbox" name="checkboxkia"
                       {{--                       style="margin-left:-10px; margin-right:-10px; text-align:left;height:18px;">--}}
                       style="margin-left:5px; margin-right:5px; text-align:left;height:15px;">
            </label>
        </div>

        {{--    //table selection section--}}
        <div class="card-body" id="table_selection">

            <div class="card-header">
                <h6 class="fw-600 mb-0">{{translate('Select the Tables to explode from Backup')}}</h6>

                <label id="ch_all">
                    <input onchange="update_all_status({{$nr}})" type="checkbox"
                           style="margin-left:5px; margin-right:5px; text-align:left;height:20px; overflow:hidden; float:left; ">{{ sprintf($msg_select_all, $nr) }}
                </label>

                <div class="card-header row gutters-5">
                    <div class="col">
                        <h5 class="mb-md-0 h6"></h5>
                    </div>
                </div>
                <div class="card-header row gutters-5">
                    <div class="col">
                        <h5 class="mb-md-0 h6"></h5>
                    </div>
                </div>
                <div class="card-header row gutters-5">
                    <div class="col">
                        <h5 class="mb-md-0 h6"></h5>
                    </div>
                </div>
                <div class="card-header row gutters-5">
                    <div class="col">
                        <h5 class="mb-md-0 h6"></h5>
                    </div>
                </div>

            </div>

            <div class="row gutters-10">
                <div class="col-lg-16">
                    <div class="card shadow-none bg-light">
                        <div class="card-body">
                            <form id="frm_cht">
                                @csrf
                                <div class="ch_tables row gutters-5">
                                    @foreach($tables as $table)
                                        @if($i >0 && ($i %$cr) == 0)
                                </div>
                                <div class="ch_tables row gutters-5">
                                    @endif
                                    <div class="col-4">
                                        <label
                                                style="margin-left:-40px; margin-right:5px; text-align:left;padding: 1px;">
                                            <input onchange="update_status(this,{{$nr}})" type="checkbox"
                                                   {{--                                                   style="margin-left:-10px; margin-right:1px; text-align:left;height:20px;"--}}
                                                   style="margin-left:25px; margin-right:5px; text-align:left;height:20px; overflow:hidden; float:left; "
                                                   name="tables[]"
                                                   value="{{ $table->$db }}">{{ $table->$db }}
                                        </label>
                                    </div>
                                    @php
                                        $i++;
                                    @endphp
                                    @endforeach
                                </div>
                            </form>

                            <div id="persian"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--    //(Create Backup) and (Check Permission) and (shre link Settings) and (Create Addons Backup) buttons section--}}
        <div class="card-header row gutters-5">
            <div class="col">

                <button data-toggle="modal" data-target="#createBackupxx"
                        onclick="show_animation_createBackup();"
                        style="margin-left:1px; margin-right:10px;"
                        class="btn btn-info">{{ translate('Create Backup') }}
                    <i class="las la-archive la-2x"></i>
                </button>

                <button data-toggle="modal" data-target="#checkPermission"
                        style="margin-left:10px; margin-right:10px;"
                        class="btn btn-info">{{ translate('Check Permission') }}
                    <i class="las la-check la-2x"></i>
                </button>

                @php
                    $logdir = base_path('databasebackups/log');
                    //check any json log file exist in log directory, if yes continue else show to user not any log file exist
                    $logcount = 0;
                    foreach (glob($logdir."/*.json") as $logfilename) {
                        if (is_file($logfilename)) {
                            $logcount = $logcount + 1;
                        }
                    }
                @endphp

                @if($logcount>0)
                    <button data-toggle="modal" data-target="#logsettings"
                            style="margin-left:10px; margin-right:10px;"
                            class="btn btn-info">{{ translate('Show log Activity') }}
                        <i class="las la-file-alt la-2x"></i>
                    </button>
                @else
                    <button
                            style="margin-left:1px; margin-right:10px;"
                            class="disabled btn btn-info">{{ translate('Show log Activity') }}
                        <i class="las la-chart-line la-2x"></i>
                    </button>
                @endif

                @php
                    $sharedir = base_path('databasebackups/share');
                    //check any json log file exist in log directory, if yes continue else show to user not any log file exist
                    $sharecount = 0;
                    foreach (glob($sharedir."/*.json") as $sharefilename) {
                        if (is_file($sharefilename)) {
                            $sharecount = $sharecount + 1;
                        }
                    }
                @endphp


                {{--                @if($status == 0)--}}
                {{--                    @can('accept_affiliate_withdraw_requests')--}}
                {{--                        <a href="#" class="btn btn-soft-primary btn-icon btn-circle btn-sm" onclick="show_affiliate_withdraw_modal('{{$affiliate_withdraw_request->id}}');" title="{{ translate('Pay Now') }}">--}}
                {{--                            <i class="las la-money-bill"></i>--}}
                {{--                        </a>--}}
                {{--                    @endcan--}}
                {{--                    @can('reject_affiliate_withdraw_request')--}}
                {{--                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm" onclick="affiliate_withdraw_reject_modal('{{route('affiliate.withdraw_request.reject', $affiliate_withdraw_request->id)}}');" title="{{ translate('Reject') }}">--}}
                {{--                            <i class="las la-trash"></i>--}}
                {{--                        </a>--}}
                {{--                    @endcan--}}
                {{--                @else--}}
                {{--                    {{ translate('No Action Available')}}--}}
                {{--                @endif--}}





                @if($sharecount>0)
                    <button data-toggle="modal" data-target="#checksharedlinks"
                            {{--                            onclick="show_check_share_modal();"--}}
                            style="margin-left:10px; margin-right:10px;"
                            class="btn btn-info">{{ translate('Check Shared Links') }}
                        <i class="las la-link la-2x"></i>
                    </button>
                @else
                    <button
                            style="margin-left:10px; margin-right:10px;"
                            class="disabled btn btn-info">{{ translate('Check Shared Links') }}
                        <i class="las la-link la-2x"></i>
                    </button>
                @endif

            </div>
        </div>

        {{--    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}
        {{--    //show table of backuped content section--}}
        <form id="sort_backupsxx" action="">

            <div class="card-body">
                {{--                <table id="BackUpTable" class="display table table-bordered table-striped">--}}
                <table id="BackUpTablexx" class="display table table-bordered StandardTable">
                    <thead>
                    <tr>
                        <th scope="ro"></th>
                        <th scope="col">{{ translate('Name') }}</th>
                        <th scope="col">{{ translate('Size KB/MB/GB') }}</th>
                        <th scope="col">{{ translate('Date') }}</th>
                        <th scope="col">{{ translate('Backup Type') }}</th>
                        <th scope="col">{{ translate('Actions') }}</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $rownumberxx = 0;
//                    $rownumber = ($pageNum > 1) ? ($pageNum * $rowsPerPage) - $rowsPerPage : 0;
                    ?>

                    @foreach ($backupsxx as $keyxx => $backupxx)
                            <?php
                            $rownumberxx++;
                            ?>
                        <tr>

                            <td class="text-dark">{{ $rownumberxx }}</td>
                            <td width="12%;" class="text-dark">{{ $backupxx['name'] }}</td>
                            <td data-title="{{translate('backup size') }} :">
                                {{ $backupxx['size'] }}
                            </td>
                            <td width="12%;"
                                data-title="{{ translate('backup created at') }} :">{{ $backupxx['date'] }}</td>
                            <td width="16%;" data-title="{{ translate('Backup Type') }} :">

                                @foreach($backup_type as $keyq => $valueq)
                                    @foreach( $backupxx['type'] as $keyqxx )
                                        @if((int)$keyqxx===(int)$keyq)
                                            <span class="badge badge-inline badge-md bg-soft-dark">{{ $valueq }}</span>
                                        @endif
                                    @endforeach
                                @endforeach

                            </td>

                            <td>
                                {{--                                <table width="100%" class="display table table-bordered StandardTable" style="margin: -10px">--}}
                                <table width="100%" style="margin: -10px;border-collapse: collapse; border: none;">

                                    <tr style="border: none;">

                                        <td width="20%;" style="border: none;">
                                            <a href="#!" data-toggle="modal"
                                               data-target="#downloadBackupxx_{{ $keyxx }}"
                                               style="margin-left:5px; margin-right:5px; font-size: .75rem;font-weight: bold;"
                                               class="btn btn-primary">{{ translate('Download') }}</a>
                                        </td>


                                        @php
                                            $sum_restoretype = 0;
                                            foreach ($backupxx['type'] as $restoretype) {
                                            $sum_restoretype = $sum_restoretype + $restoretype;
                                            }
                                        @endphp


                                        <td width="20%;" style="border: none;">
                                            @if ($sum_restoretype === 4 || $sum_restoretype === 8 || $sum_restoretype === 12 )
                                                <a href="#!" data-toggle="modal"
                                                   data-target="#restoreBackupxx_{{ $keyxx }}"
                                                   style="margin-left:5px; margin-right:5px; font-size: .75rem;font-weight: bold;"
                                                   class="disabled btn btn-warning">{{ translate('Manually') }}</a>
                                                {{--                                                   class="btn btn-warning">{{ translate('Restore Backups') }}</a>--}}
                                            @else
                                                <a id="myButton" href="#!" data-toggle="modal"
                                                   data-target="#restoreBackupxx_{{ $keyxx }}"
                                                   {{--                                                   onclick="show_animationxx('{{$backupxx['klid']}}');"--}}
                                                   onclick="show_animation_restoreBackup('{{$backupxx['klid']}}');"
                                                   {{--                                    <a href="#!" data-toggle="modal" data-target="#restoreBackup_{{ $key }}"--}}
                                                   style="margin-left:5px; margin-right:5px; font-size: .75rem;font-weight: bold;"
                                                   class="btn btn-warning">{{ translate('Restore') }}</a>
                                            @endif

                                        </td>

                                        <td width="20%;" style="border: none;">
                                            <a href="#!" data-toggle="modal" data-target="#deleteBackupxx_{{ $keyxx }}"
                                               style="margin-left:5px; margin-right:5px; font-size: .75rem;font-weight: bold;"
                                               class="btn btn-danger">{{ translate('Delete') }}</a>

                                        </td>
                                        <td width="32%;" style="border: none;">
                                            {{--                                            <a href="#!" id="shareId_{{$backupxx['klid']}}" data-toggle="modal"--}}
                                            {{--                                               data-target="#sharefilesmodalxx"--}}
                                            {{--                                               data-id="{{ json_encode($backupxx['type']) }}"--}}
                                            {{--                                               onclick="show_share_frm('{{$backupxx['klid']}}', {{ $keyxx }}, {{json_encode($backupxx['type'])}} );"--}}
                                            {{--                                               style="margin-left:5px; margin-right:5px; font-size: .75rem;font-weight: bold;"--}}
                                            {{--                                               class="btn btn-info">{{ translate('Share') }}--}}
                                            {{--                                            </a>--}}



                                            {{--                                            <a href="#" class="btn btn-soft-primary btn-icon btn-circle btn-sm"--}}
                                            {{--                                               onclick="show_share_modal('{{$backupxx['klid']}}');"--}}
                                            {{--                                               title="{{ translate('Share Now') }}">--}}
                                            {{--                                               <i class="las la-share"></i>--}}
                                            {{--                                            </a>--}}

                                            <a href="#!" id="shareId_{{$backupxx['klid']}}" data-toggle="modal"
                                               data-id="{{ json_encode($backupxx['type']) }}"
                                               onclick="show_share_modal('{{$backupxx['klid']}}');"
                                               style="margin-left:5px; margin-right:5px; font-size: .75rem;font-weight: bold;"
                                               class="btn btn-info">{{ translate('Share') }}
                                            </a>



                                        </td>
                                    </tr>
                                </table>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </form>
        {{--    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

    </div>


    {{--    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

    {{--    //create backup section--}}
    <div class="modal fade" id="createBackupxx" tabindex="-1" role="dialog" aria-labelledby="createBackupxx"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ translate('Generate New Backup') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{--                <form id="frm_backup" action="{{ route('backups.store') }}" method="POST">--}}
                <form id="frm_createBackupxx" action="{{ route('backups.storexx') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group required">
                            <label for="name">{{ translate('Name') }}</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder={{ translate('Optional Auto Generate') }}>
                            {{--                                   placeholder={{ translate('Name') }}: {{ translate('Optional Auto Generate') }}>--}}
                            {{--                                   placeholder={{ translate('Name') }}: {{ translate('Optional') }}>--}}
                        </div>

                        @php
                            $addonsdir = public_path('addons');
                            //check any zip file exist in addons directory, if yes continue else show to user not any zip file exist
                            $addons_installed_count = 0;
                            foreach (glob($addonsdir."/*.zip") as $filename) {
                                if (is_file($filename)) {
                                    $addons_installed_count = $addons_installed_count + 1;
                                }
                            }
//                            $addons_installed_count = 0;
                        @endphp

                        <div class="backup-choose-list">
                            <div class="backup-choose">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-from-label"
                                           for="name">{{translate('Choose Your Backup Type')}}</label>
                                    <div class="col-lg-9">
                                        {{--                                    $backup_type = array(--}}
                                        {{--                                    "1" => "DataBase",--}}
                                        {{--                                    "2" => "Folder",--}}
                                        {{--                                    "4" => "Addons",--}}
                                        {{--                                    "8" => "WebSite",--}}
                                        {{--                                    );--}}
                                        @php
                                            $disabled_msg = '  '. translate('(Disabled, because you have not installed any plugins)') ;
                                            $enabled_msg = '  '. translate('Create Backup From Installed Addons') . '(' . $addons_installed_count . translate('addons') . ')';
                                            $enabled_msg = '  '. translate('Installed Addons') . '(' . $addons_installed_count . translate('addons') . ')';

                                        @endphp

                                        <select name="backup_ids[]" class="form-control backup_id aiz-selectpicker"
                                                data-live-search="true" data-selected-text-format="count" required
                                                multiple>
                                            @foreach($backup_type as $keyq => $valueq)

                                                @php
                                                    if($keyq===4){
                                                        if($addons_installed_count<1){
                                                            $valueq .= $disabled_msg;
                                                        }
                                                        else {
                                                            $valueq .= $enabled_msg;
                                                        }
                                                    }
                                                @endphp

                                                <option value="{{$keyq}}"
                                                        @if ($keyq===4 && $addons_installed_count<1) disabled
                                                        style="color: #ff7e00;font-size: .99rem;font-weight: bold;"
                                                        @elseif ($keyq===4 && $addons_installed_count>0) style="color: #206b07;font-size: .99rem;font-weight: bold;"
                                                        {{--                                                    @elseif ($keyq===4 && $addons_installed_count>0)--}}
                                                        @endif
                                                >{{ $valueq }}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="checkboxeslistzz" name="checkboxeslist" value="[]"/>
                        <input type="hidden" id="tablecount" name="tablecount" value="{{ count($tables) }}"/>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ translate('Cancel') }}</button>
                            <button type="submit"
                                    class="btn btn-success">{{ translate('Generate') }}</button>
                        </div>

                    </div>
                </form>

                <div style="display:none;" id="PersianGulf_CreateBackup" class="currently-loading">
                </div>

            </div>
        </div>
    </div>


    {{--        //download, restore and delete section--}}
    @foreach ($backupsxx as $keyxx => $backupxx)
        {{--        //download section--}}
        <div class="modal fade" id="downloadBackupxx_{{ $keyxx }}" tabindex="-1" role="dialog"
             aria-labelledby="downloadBackupxx_{{ $keyxx }}" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ translate('confirm download') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div style="color: #ff7e00;background-color:#ffc405;border-color:#f6a662;margin-left: 1rem; margin-right: 1rem;"
                         class="alert alert-warning" role="alert">
                        <b>{{ translate('Do you really want to download this backups?') }}</b>
                    </div>
                    {{--@php--}}
                    {{--    $arr= [64,32,16,8,4,2,1];--}}
                    {{--    $number = 126;--}}
                    {{--    $bin = str_split(str_pad(decbin($number),count($arr),"0",STR_PAD_LEFT));--}}

                    {{--   $kiakia = implode(",", array_intersect_key($arr,array_intersect($bin, ["1"])));--}}


                    {{--   @endphp--}}
                    {{--@dd($kiakia)--}}
                    {{--@php--}}
                    {{--                    $n = 126;--}}
                    {{--                    $n |= 0;--}}
                    {{--                    $pad = 0;--}}
                    {{--                    $arr = array();--}}
                    {{--                    while ($n) {--}}
                    {{--                    if ($n & 1) array_push($arr, 1 << $pad);--}}
                    {{--                    $pad++;--}}
                    {{--                    $n >>= 1;--}}
                    {{--                    }--}}
                    {{--                    $kiakia = $arr;--}}
                    {{--   @endphp--}}
                    {{--   @dd($kiakia)--}}

                    <form id="frm_downloadBackupxx_{{ $backupxx['klid'] }}"
                          action="{{ route('backups.download.backups') }}" method="POST">
                        @csrf
                        <div class="modal-body">

                            <input type="hidden" name="key" value="{{ $keyxx }}"/>
                            <input type="hidden" name="backuptype" value="{{ json_encode($backupxx['type']) }}"/>

                            <div class="download-choose-list">
                                <div class="download-choose">
                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label"
                                               for="name">{{translate('download')}}</label>
                                        <div class="col-lg-9">
                                            <select name="backup_ids[]" class="form-control product_id aiz-selectpicker"
                                                    data-live-search="true" data-selected-text-format="count" required
                                                    multiple>
                                                @foreach($backup_type as $keyq => $valueq)
                                                    @foreach( $backupxx['type'] as $keyqxx )
                                                        @if((int)$keyqxx===(int)$keyq)
                                                            @switch((int)$keyqxx)

                                                                @case(1)
                                                                    @php
                                                                        //"1" => "DataBase"
                                                                            $righ = '0';
                                                                                $path = base_path('databasebackups/') . $keyxx;
                                                                                foreach (scanFolder($path) as $file) {
                                                                                    if (strpos(basename($file), 'database') !== false) {
                                                                               $righ=formatsize(getFileSize($path . DIRECTORY_SEPARATOR . $file));
                                                                                    }
                                                                                }
                                                                    @endphp
                                                                    @break

                                                                @case(2)
                                                                    @php
                                                                        //"2" => "Folder"
                                                                            $righ = '0';
                                                                             $path = base_path('databasebackups/') . $keyxx;
                                                                             foreach (scanFolder($path) as $file) {
                                                                                 if (strpos(basename($file), 'storage') !== false) {
                                                                            $righ=formatsize(getFileSize($path . DIRECTORY_SEPARATOR . $file));
                                                                                 }
                                                                             }
                                                                    @endphp
                                                                    @break

                                                                @case(4)
                                                                    @php
                                                                        //"4" => "Addons"
                                                                            $righ = '0';
                                                                             $path = base_path('databasebackups/') . $keyxx;
                                                                             foreach (scanFolder($path) as $file) {
                                                                                 if (strpos(basename($file), 'addons') !== false) {
                                                                            $righ=formatsize(getFileSize($path . DIRECTORY_SEPARATOR . $file));
                                                                                 }
                                                                             }
                                                                    @endphp
                                                                    @break

                                                                @case(8)
                                                                    @php
                                                                        //"8" => "WebSite"
                                                                            $righ = '0';
                                                                             $path = base_path('databasebackups/') . $keyxx;
                                                                             foreach (scanFolder($path) as $file) {
                                                                                 if (strpos(basename($file), 'website') !== false) {
                                                                            $righ=formatsize(getFileSize($path . DIRECTORY_SEPARATOR . $file));
                                                                                 }
                                                                             }
                                                                    @endphp
                                                                    @break
                                                                @default
                                                            @endswitch
                                                            @php
                                                                $valueq .= '   : '.$righ;
                                                            @endphp
                                                            <option value="{{$keyq}}"

                                                            >{{$valueq}}</option>

                                                        @endif
                                                    @endforeach
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="alert alert-warning" role="alert">
                                <b>{{ translate('Note: You can only restore the database and folder. To restore the plugins or the website, proceed manually.') }}</b>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ translate('Cancel') }}
                                </button>
                                <button type="submit" class="btn btn-primary">{{ translate('Download') }}</button>
                            </div>
                        </div>


                    </form>
                    {{--                    <div id="PersianGulf_downloadBackupxx_{{ $backupxx['klid'] }}"></div>--}}
                    {{--                    <div style="display:none;" id="PersianGulf_DownloadBackup{{ $backupxx['klid'] }}" class="currently-loading"></div>--}}


                </div>
            </div>
        </div>


        {{--        //restore section--}}
        <div class="modal fade" id="restoreBackupxx_{{ $keyxx }}" tabindex="-1" role="dialog"
             aria-labelledby="restoreBackupxx_{{ $keyxx }}" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ translate('confirm download') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div style="margin-left: 1rem; margin-right: 1rem;" class="alert alert-warning" role="alert">
                        <b>{{ translate('Do you really want to restore this backups?') }}</b>
                    </div>

                    <form id="frm_restoreBackupxx_{{ $backupxx['klid'] }}"
                          action="{{ route('backups.download.restore') }}" method="POST">
                        @csrf
                        <div class="modal-body">

                            <input type="hidden" name="key" value="{{ $keyxx }}"/>
                            <input type="hidden" name="backuptype" value="{{ json_encode($backupxx['type']) }}"/>

                            <div class="restore-choose-list">
                                <div class="restore-choose">
                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label"
                                               for="name">{{translate('restore')}}</label>
                                        <div class="col-lg-9">
                                            @php
                                                $addonsdir = public_path('addons');
                                                //check any zip file exist in addons directory, if yes continue else show to user not any zip file exist
                                                $addons_installed_count = 0;
                                                foreach (glob($addonsdir."/*.zip") as $filename) {
                                                    if (is_file($filename)) {
                                                        $addons_installed_count = $addons_installed_count + 1;
                                                    }
                                                }
//                                                $disabled_addons_msg = '  ('. translate('Restore Disabled,Please Restore Manually, Installed Addons') . ')(' . $addons_installed_count . translate('addons') . ')';
//                                                $disabled_website_msg = '  ('. translate('Restore Disabled,Please Restore Manually').')';
                                                $disabled_addons_msg = '  ('. translate('Please Restore Manually, Installed Addons') . ')(' . $addons_installed_count . translate('addons') . ')';
                                                $disabled_website_msg = '  ('. translate('Please Restore Manually').')';

                                            @endphp
                                            <select name="restore_ids[]"
                                                    class="form-control product_id aiz-selectpicker"
                                                    data-live-search="true" data-selected-text-format="count" required
                                                    multiple>
                                                @foreach($backup_type as $keyq => $valueq)
                                                    @foreach( $backupxx['type'] as $keyqxx )
                                                        @if((int)$keyqxx===(int)$keyq)
                                                            @switch((int)$keyqxx)

                                                                @case(1)
                                                                    @php
                                                                        //"1" => "DataBase"
                                                                            $righ = '0';
                                                                                $path = base_path('databasebackups/') . $keyxx;
                                                                                foreach (scanFolder($path) as $file) {
                                                                                    if (strpos(basename($file), 'database') !== false) {
                                                                               $righ=formatsize(getFileSize($path . DIRECTORY_SEPARATOR . $file));
                                                                                    }
                                                                                }
                                                                    @endphp
                                                                    @break

                                                                @case(2)
                                                                    @php
                                                                        //"2" => "Folder"
                                                                            $righ = '0';
                                                                             $path = base_path('databasebackups/') . $keyxx;
                                                                             foreach (scanFolder($path) as $file) {
                                                                                 if (strpos(basename($file), 'storage') !== false) {
                                                                            $righ=formatsize(getFileSize($path . DIRECTORY_SEPARATOR . $file));
                                                                                 }
                                                                             }
                                                                    @endphp
                                                                    @break

                                                                @case(4)
                                                                    @php
                                                                        //"4" => "Addons"
                                                                            $righ = '0';
                                                                             $path = base_path('databasebackups/') . $keyxx;
                                                                             foreach (scanFolder($path) as $file) {
                                                                                 if (strpos(basename($file), 'addons') !== false) {
                                                                            $righ=formatsize(getFileSize($path . DIRECTORY_SEPARATOR . $file));
                                                                                 }
                                                                             }

                                                                             $righ .= $disabled_addons_msg;
                                                                    @endphp
                                                                    @break

                                                                @case(8)
                                                                    @php
                                                                        //"8" => "WebSite"
                                                                            $righ = '0';
                                                                             $path = base_path('databasebackups/') . $keyxx;
                                                                             foreach (scanFolder($path) as $file) {
                                                                                 if (strpos(basename($file), 'website') !== false) {
                                                                            $righ=formatsize(getFileSize($path . DIRECTORY_SEPARATOR . $file));
                                                                                 }
                                                                             }

                                                                             $righ .= $disabled_website_msg;
                                                                    @endphp
                                                                    @break
                                                                @default
                                                            @endswitch
                                                            @php
                                                                $valueq .= '   : '.$righ;
                                                            @endphp
                                                            <option value="{{$keyq}}"
                                                                    @if ($keyq===4 || $keyq===8 ) disabled
                                                                    style="color: #ff7e00;font-size: .75rem;font-weight: bold;"
                                                                    @else style="color: #206b07;font-size: .75rem;font-weight: bold;"
                                                                    @endif
                                                            >{{$valueq}}</option>

                                                        @endif
                                                    @endforeach
                                                @endforeach

                                            </select>


                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="alert alert-warning" role="alert">
                                <b>{{ translate('Note: You can only restore the database and folder. To restore the plugins or the website, proceed manually.') }}</b>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ translate('Cancel') }}
                                </button>
                                <button type="submit" class="btn btn-warning">{{ translate('Restore') }}</button>
                            </div>
                        </div>


                    </form>
                    {{--                    <div id="PersianGulf_restoreBackupxx_{{ $backupxx['klid'] }}"></div>--}}
                    <div style="display:none;" id="PersianGulf_RestoreBackup_{{ $backupxx['klid'] }}" class="currently-loading">
                    </div>


                </div>
            </div>
        </div>


        {{--        //delete section--}}
        <div class="modal fade" id="deleteBackupxx_{{ $keyxx }}" tabindex="-1" role="dialog"
             aria-labelledby="deleteBackupxx_{{ $keyxx }}" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ translate('confirm delete') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div style="margin-left: 1rem; margin-right: 1rem;" class="alert alert-danger" role="alert">
                        <b>{{ translate('Do you really want to delete this backup?') }}</b>
                    </div>

                    <form id="frm_deleteBackupxx_{{ $backupxx['klid'] }}"
                          action="{{ route('backups.download.delete') }}" method="POST">
                        @csrf
                        {!! method_field('DELETE') !!}
                        <div class="modal-body">

                            <input type="hidden" name="key" value="{{ $keyxx }}"/>
                            <input type="hidden" name="backuptype" value="{{ json_encode($backupxx['type']) }}"/>

                            <div class="delete-choose-list">
                                <div class="delete-choose">
                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label" for="name">{{translate('delete')}}</label>
                                        <div class="col-lg-9">
                                            <select name="delete_ids[]" class="form-control product_id aiz-selectpicker"
                                                    data-live-search="true" data-selected-text-format="count" required
                                                    multiple>
                                                @foreach($backup_type as $keyq => $valueq)
                                                    @foreach( $backupxx['type'] as $keyqxx )
                                                        @if((int)$keyqxx===(int)$keyq)
                                                            @switch((int)$keyqxx)

                                                                @case(1)
                                                                    @php
                                                                        //"1" => "DataBase"
                                                                            $righ = '0';
                                                                                $path = base_path('databasebackups/') . $keyxx;
                                                                                foreach (scanFolder($path) as $file) {
                                                                                    if (strpos(basename($file), 'database') !== false) {
                                                                               $righ=formatsize(getFileSize($path . DIRECTORY_SEPARATOR . $file));
                                                                                    }
                                                                                }
                                                                    @endphp
                                                                    @break

                                                                @case(2)
                                                                    @php
                                                                        //"2" => "Folder"
                                                                            $righ = '0';
                                                                             $path = base_path('databasebackups/') . $keyxx;
                                                                             foreach (scanFolder($path) as $file) {
                                                                                 if (strpos(basename($file), 'storage') !== false) {
                                                                            $righ=formatsize(getFileSize($path . DIRECTORY_SEPARATOR . $file));
                                                                                 }
                                                                             }
                                                                    @endphp
                                                                    @break

                                                                @case(4)
                                                                    @php
                                                                        //"4" => "Addons"
                                                                            $righ = '0';
                                                                             $path = base_path('databasebackups/') . $keyxx;
                                                                             foreach (scanFolder($path) as $file) {
                                                                                 if (strpos(basename($file), 'addons') !== false) {
                                                                            $righ=formatsize(getFileSize($path . DIRECTORY_SEPARATOR . $file));
                                                                                 }
                                                                             }
                                                                    @endphp
                                                                    @break

                                                                @case(8)
                                                                    @php
                                                                        //"8" => "WebSite"
                                                                            $righ = '0';
                                                                             $path = base_path('databasebackups/') . $keyxx;
                                                                             foreach (scanFolder($path) as $file) {
                                                                                 if (strpos(basename($file), 'website') !== false) {
                                                                            $righ=formatsize(getFileSize($path . DIRECTORY_SEPARATOR . $file));
                                                                                 }
                                                                             }
                                                                    @endphp
                                                                    @break
                                                                @default
                                                            @endswitch
                                                            @php
                                                                $valueq .= '   : '.$righ;
                                                            @endphp
                                                            <option value="{{$keyq}}"

                                                            >{{$valueq}}</option>

                                                        @endif
                                                    @endforeach
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="alert alert-warning" role="alert">
                                <b>{{ translate('Note: You can only restore the database and folder. To restore the plugins or the website, proceed manually.') }}</b>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ translate('Cancel') }}
                                </button>
                                <button type="submit" class="btn btn-danger">{{ translate('Delete') }}</button>
                            </div>
                        </div>


                    </form>
                    <div id="PersianGulf_deleteBackupxx_{{ $backupxx['klid'] }}"></div>


                </div>
            </div>
        </div>

    @endforeach


    {{--    //share section--}}
    {{--    Set Bootstrap modal content to scroll if height exceeds browser--}}

    {{--    For Bootstrap versions >= 4.3 just add the class modal-dialog-scrollable to the same div that has the modal-dialog class.--}}

    {{--    For Bootstrap versions < 4.3:--}}
    {{--    --}}
    {{--    #scrollbox {--}}
    {{--    border: 1px solid red;--}}
    {{--    overflow-y: auto;--}}
    {{--    max-height: calc(100vh - 150px);--}}
    {{--    }--}}

    {{--    <div class="modal-body">--}}
    {{--    <div id="scrollbox">--}}
    {{--        .--}}
    {{--        .--}}
    {{--        .--}}
    {{--        .--}}
    {{--    </div>--}}

    {{--   //Check Shared Links section--}}
    <div class="modal fade" id="checksharedlinks" tabindex="-1" role="dialog"
         aria-labelledby="checksharedlinks" aria-hidden="true">
        <div class="modal-body">

            <div class="modal-dialog modal-xls">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ translate('Check Shared Links') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="row">

                        <div class="card-body">
                            <div style="height:630px; overflow-y: scroll;">

                                @if(!empty($members))
                                    <table id="ShareTable" class="display table table-striped table-bordered StandardTable"
                                           width="100%">

                                        {{--                                        <thead class="thead-dark">--}}
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{translate('Attachments')}}</th>
                                            <th>{{translate('Size')}}</th>
                                            <th>{{translate('TIme Check')}}</th>
                                            <th>{{translate('Download Type')}}</th>
                                            <th>{{translate('Password')}}</th>
                                            <th>{{translate('Created at')}}</th>
                                            <th>{{translate('Lifetime')}}</th>
                                            <th>{{translate('Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="userData">
                                        @if(!empty($members))
                                                <?php
                                                $count = 0;
//                                            $count = ($pageNum2 > 1) ? ($pageNum2 * $rowsPerPage2) - $rowsPerPage2 : 0;
                                                ?>

                                            @foreach ($members as $keymember => $member)
                                                    <?php
                                                    $count++;
                                                    ?>
                                                <tr>
                                                    <td width="3%;"><?php echo $count; ?></td>
                                                    @php
                                                        $totalsize_x = 0;
                                                        $countfiles_x = 0;
                                                        $myfilesnamex_x = "<ul>";
                                                        $myfilessizex_x = "<ul style='list-style: none;'>";
                                                        $myfilesexpire_x = "<ul style='list-style: none;'>";
                                                        $count_file_exist = 0;
                                                        if (count($member['attachmentsxx'])>0 && !empty($member['attachmentsxx']) && $member['attachmentsxx'] !=null) {
                                                            $pieces_xoldoldold = explode(",", $member['attachments']);
                                                            $pieces_x = $member['attachmentsxx'];
                                                            foreach ($pieces_x as $count_x => $pezzo_x) {
                                                                   $myfile_x = urldecode(base64_decode($pezzo_x)); //==> databasebackups/2024-01-03-13-42-40/database-2024-01-03-13-42-40.zip
                                                                   if (file_exists($myfile_x)) {
                                                                        $filepathinfo_x = mbPathinfo($myfile_x);
                                                                        $filename_x = $filepathinfo_x['basename'];
                                                                        $extension_x = strtolower($filepathinfo_x['extension']);
                                                                        $filesize_x = getFileSize($myfile_x);
                                                                        $totalsize_x += $filesize_x;
                                                                        $countfiles_x++;
                                                                        $expired ='<span class="badge badge-inline badge-success" style="font-size:.95rem;color:#206B07FF;">'. translate("exist")  .'</span>';
                                                                        $myfilesnamex_x .= "<li>".$filename_x.' ('.$expired.')'."</li>";
                                                                        $myfilessizex_x .= "<li>".formatSize($filesize_x)."</li>";
                                                                        $myfilesexpire_x .= "<li>".$expired."</li>";
                                                                        $count_file_exist++;
                                                                   }
                                                                   else {
                                                                     $expired ='<span class="badge badge-inline badge-warning" style="font-size:.95rem;color:#e70060;">'. translate("deleted")  .'</span>';
                                                                     $filepathinfo_x = mbPathinfo($myfile_x);
                                                                     $filename_x = $filepathinfo_x['basename'];
                                                                     $myfilesnamex_x .= "<li>".$filename_x.' ('.$expired.')'."</li>";
                                                                     $myfilesexpire_x .= "<li>".$expired."</li>";
                                                                   }
                                                            }
                                                        } else {
                                                            $expired ='<span class="badge badge-inline badge-warning" style="font-size:.95rem;color:#e70060;">'. translate("expired")  .'</span>';
                                                            $myfilesnamex_x .= "<li>".$expired."</li>";
                                                            $myfilesexpire_x .= "<li>".$expired."</li>";
                                                        }
                                                        $myfilesnamex_x .= "</ul>";
                                                        $myfilessizex_x .= "</ul>";
                                                        $myfilesexpire_x .= "</ul>";

                                                        $lifetimevariable = $member['lifetime'];
                                                        $lifetimetimestr  = $member['lifetime'] .' '. translate('days');


                                                    @endphp
                                                    <td width="25%;"><?php echo $myfilesnamex_x; ?></td>

                                                    <td width="9%"><?php echo $myfilessizex_x; ?></td>
                                                    <td width="10%;">

                                                        @php
                                                            $bigger_smaller = checkTimeBiggerOrSmaler($member['time'], $member['lifetime']);
                                                        @endphp

                                                        @if ($bigger_smaller === 0)
                                                            <span class="badge badge-inline badge-warning"
                                                                  style="font-size: .75rem;font-weight: bold;">{{secondsToWords($member['time'] -  time())}} {{ translate('until activation') }}</span>
                                                        @elseif ($bigger_smaller === 1)
                                                            <span class="badge badge-inline badge-danger"
                                                                  style="font-size: .75rem;font-weight: bold;">{{ translate('Download Time Expired') }}</span>
                                                        @elseif ($bigger_smaller === 10)
                                                            <span class="badge badge-inline badge-success"
                                                                  style="font-size: .75rem;font-weight: bold;">{{secondsToWords(($member['time'] + (86400 * $member['lifetime'])) -  time())}} {{ translate('until expiration') }}</span>
                                                        @endif


                                                    </td>

                                                    <td width="10%;">
                                                        @if ($member['onetime'] == 1)
                                                            <span class="badge badge-inline badge-danger"
                                                                  style="font-size: .75rem;font-weight: bold;">{{ translate('Onetime') }}</span>
                                                        @else
                                                            <span class="badge badge-inline badge-success"
                                                                  style="font-size: .75rem;font-weight: bold;">{{ translate('Lifetime') }}</span>
                                                        @endif
                                                    </td>

                                                    <td width="7%;">
                                                            <?php $haspass = $member['pass'] === 'false' ? false : true; ?>
                                                        @php
                                                            if ($member['pass'] === false || $member['pass'] === 'false' || $member['pass'] === null || strlen($member['pass']) < 8 ){
                                                                $haspass = false;
                                                            } elseif (strlen($member['pass']) > 8 && $member['pass'] != null) {
                                                                $haspass = true;
                                                            }
                                                        @endphp
                                                        {{--                                                        @dd($member['pass'])--}}
                                                        @if ($haspass)
                                                            <span class="badge badge-inline badge-success"
                                                                  style="font-size: .75rem;font-weight: bold;">{{ translate('Yes') }}</span>
                                                        @else
                                                            <span class="badge badge-inline badge-warning"
                                                                  style="font-size: .75rem;font-weight: bold;">{{ translate('No') }}</span>
                                                        @endif
                                                    </td>

                                                    <td width="11%;">{{ date('Y/m/d - H:i:s', $member['time'])  }}</td>

                                                    <td width="7%;">
                                                        @if ($member['onetime'] == 1)
                                                            <span class="badge badge-inline badge-danger"
                                                                  style="font-size: .75rem;font-weight: bold;">{{ $lifetimetimestr }}</span>
                                                        @else
                                                            <span class="badge badge-inline badge-success"
                                                                  style="font-size: .75rem;font-weight: bold;">{{ $lifetimetimestr }}</span>
                                                        @endif
                                                    </td>


                                                    <td>
                                                        @if($count_file_exist>0)
                                                            <a href="#!" data-toggle="modal"
                                                               data-target="#editShareLink_{{ $keymember }}"
                                                               style="margin-left:5px; margin-right:5px; font-size: .85rem;font-weight: bold;"
                                                               class="btn btn-info">{{ translate('Edit Link') }}</a>
                                                        @else
                                                            <a href="#!" data-toggle="modal"
                                                               data-target="#editShareLink_{{ $keymember }}"
                                                               style="margin-left:5px; margin-right:5px; font-size: .85rem;font-weight: bold;"
                                                               class="disabled btn btn-info">{{ translate('Edit Link') }}</a>
                                                        @endif
                                                    </td>
                                                </tr>

                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="8">No member(s) found...</td>
                                            </tr>
                                        @endif

                                        </tbody>
                                    </table>
                                @else
                                    <tr>
                                        <td colspan="8">No member(s) found...</td>
                                    </tr>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{--    //edit shared link info section--}}
    @if($members)
        @foreach ($members as $keymember => $member)
            <div class="modal fade" id="editShareLink_{{ $keymember }}" tabindex="-1" role="dialog"
                 aria-labelledby="editShareLink_{{ $keymember }}" aria-hidden="true">
                {{--                <div class="modal-dialog modal-dialog-centered modal-mediumlg" role="document">--}}
                <div class="modal-dialog modal-dialog-centered modal-lg  modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ translate('Confirm Edit') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>


                        @php
                            $read_link = env('APP_URL') . '/backups/viewfilefromlink/' . $member['idfilename'];
                            $lifetimevariable = $member['lifetime'];
                            $lifetimetimestr  = $member['lifetime'] .' '. translate('days');

                            $path = base_path('databasebackups/') . $member['backupname'];

                            $start_date = $member['time'] ? date('d-m-Y H:i:s', $member['time']) : null;
                            $lifetime = isset($member['lifetime']) ? (int)$member['lifetime'] : 1;
                            $lifedays = 86400 * $lifetime;
                            $end_date   = $member['time'] ? date('d-m-Y H:i:s', $member['time']+$lifedays) : null;
                        @endphp
                        <div class="modal-header">
                            {{--                        <div class="form-group shalink mb-6">--}}
                            <div class="input-group">
                            <span class="input-group-btn">
                                <a class="btn btn-info sharebutt2" href="{{$read_link}}" target="_blank"
                                   style="height:42px;"><i
                                            class="las la-link"></i></a>
                            </span>
                                <input id="copylink2_{{ $keymember }}" class="form-control" type="text"
                                       onclick="this.select()"
                                       value="{{$read_link}}" readonly>
                                <span class="input-group-btn">
                                    <button onclick="copyToClipBoard2(this,{{$keymember}});" class="btn btn-info"
                                            data-bs-toggle="popover" data-bs-placement="bottom"
                                            data-bs-content=" {{ translate('copied') }}"
                                            data-clipboard-target="#copylink2" style="height:42px;">
                                        <i class="las la-clipboard-check"></i>
                                    </button>
                                </span>
                            </div>
                            {{--                        </div>--}}
                        </div>

                        <form class="form-horizontal" id="frm_editsharelink{{ $member['idfilename'] }}"
                              action="{{ route('backups.editsharelink') }}" method="POST">
                            @csrf
                            <input type="hidden" name="keymember" value="{{ $keymember }}"/>
                            <input type="hidden" name="idkey" value="{{ $member['idfilename'] }}"/>
                            <input type="hidden" name="passkey" value="{{ $member['pass'] }}"/>
                            <input type="hidden" name="datetimekey" value="{{ $member['time'] }}"/>
                            <input type="hidden" name="backupname" value="{{ $member['backupname'] }}"/>
                            <div class="modal-body">


                                <div class="form-group row">
                                    <div class="col-md-10">
                                        <div class="input-group">

                                            @if (\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1 &&
   Session::get('locale', Config::get('app.locale')) == 'ir')
                                                <label class="form-label"
                                                       style="color: #000d80;margin-top:13px;margin-right:-1px;display:block;width:190px;">{{ translate('One-time download') }}
                                                    :</label>
                                            @else
                                                <label class="form-label"
                                                       style="color: #000d80;margin-top:13px;margin-right:10px;display:block;">{{ translate('One-time download') }}
                                                    :</label>
                                            @endif

                                            <input type="checkbox" name="onetime_link"
                                                   style="background-color: #00bbf2; margin-left:35px; margin-right:5px; margin-top:15px; text-align:left;height:18px;"
                                                   @if($member['onetime'] == 1) checked @endif>

                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            @if (\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1 &&
   Session::get('locale', Config::get('app.locale')) == 'ir')
                                                <label class="form-label"
                                                       style="color: #000d80;margin-top:13px;margin-right:-1px;display:block;width:190px;">{{ translate('Keep links valid for') }}
                                                    :</label>
                                            @else
                                                <label class="form-label"
                                                       style="color: #000d80;margin-top:13px;margin-right:-30px;display:block;width:190px;">{{ translate('Keep links valid for') }}
                                                    :</label>
                                            @endif
                                            <select class="form-control aiz-selectpicker rounded-0"
                                                    data-live-search="true"
                                                    data-placeholder="{{ translate('Select lifetime type')}}"
                                                    style="width:230px;"
                                                    name="lifetime_link" disabled>
                                                <option value="">{{ translate('Select lifetime type') }}</option>

                                                <option value="{{ $member['lifetime'] }}"
                                                        @if($member['lifetime'] == $lifetimevariable) selected @endif>
                                                    {{ $lifetimetimestr }}
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            @if (\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1 &&
   Session::get('locale', Config::get('app.locale')) == 'ir')
                                                <label class="form-label"
                                                       style="color: #000d80;margin-top:13px;margin-right:-1px;display:block;width:190px;">{{ translate('renew password?') }}
                                                    :</label>
                                            @else
                                                <label class="form-label"
                                                       style="color: #000d80;margin-top:13px;margin-right:-30px;display:block;width:190px;">{{ translate('renew password?') }}
                                                    :</label>
                                            @endif
                                            <span class="input-group-text"><i class="las la-lock-open"
                                                                              style="color:#00bbf2;font-size: 18px;"></i></span>
                                            <input class="form-control" type="hidden" id="oldpasslink_{{ $keymember }}"
                                                   name="oldpasslink_{{ $keymember }}" value="{{$member['pass']}}">

                                            <input class="form-control" type="text" id="updatepasslink_{{ $keymember }}"
                                                   name="updatepasslink_{{ $keymember }}"
                                                   onclick="this.select()"
                                                   placeholder="{{ translate('random password') }}"
                                                   style="width:230px;"
                                                   value="">

                                            <span class="input-group-btn">
                                                  <a href="#" onclick='updatePassword(this, "{{ $keymember }}")'
                                                     class="btn btn-info "
                                                     style="height:42px;">
                                                  <i class="las la-mouse-pointer la-2x"></i></a>
                                            </span>




                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            @if (\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1 &&
   Session::get('locale', Config::get('app.locale')) == 'ir')
                                                <label class="form-label"
                                                       style="color: #000d80;margin-top:13px;margin-right:-1px;display:block;width:190px;">{{ translate('edit shared files?') }}
                                                    :</label>
                                            @else
                                                <label class="form-label"
                                                       style="color: #000d80;margin-top:13px;margin-right:-30px;display:block;width:190px;">{{ translate('edit shared files?') }}
                                                    :</label>
                                            @endif


                                            <select name="edit_ids[]" class="form-control product_id aiz-selectpicker"
                                                    data-live-search="true" data-selected-text-format="count" required
                                                    multiple>
                                                @foreach (scanFolder($path) as $file) {
                                                {{--                                                            @foreach ($member['attachmentsxx'] as $count_x => $pezzo_x) {--}}
                                                @php

                                                    $righ = 0;
                                                    $keyq = 0;
                                                    $valueq ='';

                                                   switch (true) {
                                                       case (strpos(basename($file), 'database') !== false):
                                                            $righ=formatsize(getFileSize($path . DIRECTORY_SEPARATOR . $file));
                                                            $keyq = 1;
                                                            $valueq ='DataBase';
                                                           break;
                                                       case (strpos(basename($file), 'storage') !== false):
                                                            $righ=formatsize(getFileSize($path . DIRECTORY_SEPARATOR . $file));
                                                            $keyq = 2;
                                                            $valueq ='Folder';
                                                           break;
                                                       case (strpos(basename($file), 'addons') !== false):
                                                            $righ=formatsize(getFileSize($path . DIRECTORY_SEPARATOR . $file));
                                                            $keyq = 4;
                                                            $valueq ='Addons';
                                                           break;
                                                       case (strpos(basename($file), 'website') !== false):
                                                            $righ=formatsize(getFileSize($path . DIRECTORY_SEPARATOR . $file));
                                                            $keyq = 8;
                                                            $valueq ='Website';
                                                           break;
                                                       default:
                                                   }
                                                    $issharedcheck = '';
                                                    $shareded_msg = '  '. translate('(Not selected for sharing)') ;
                                                    $valuekey = $keyq;

                                                    foreach ($member['attachmentsxx'] as $count_x => $pezzo_x){
                                                        $myfile = urldecode(base64_decode($pezzo_x)); //==> databasebackups/2024-01-03-13-42-40/database-2024-01-03-13-42-40.zip
                                                        if (strpos(basename($myfile), basename($file)) !== false) {
                                                            $issharedcheck = 'selected';
                                                            $shareded_msg = '  '. translate('(Selected for sharing)') ;
                                                        }
                                                    }
                                                    $valueq .= ' ' .$righ . ' ' . $shareded_msg;
                                                @endphp

                                                {{--                                                            <option value="{{$keyq}}" {{$issharedcheck}}--}}
                                                <option value="{{$valuekey}}" {{$issharedcheck}}
                                                @if ($issharedcheck==='selected')
                                                    style="color: #206b07;font-size: .75rem;font-weight: bold;"
                                                        @else
                                                            style="color: #ff7e00;font-size: .75rem;font-weight: bold;"
                                                        @endif
                                                >{{$valueq}}
                                                </option>
                                                @endforeach
                                            </select>


                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            @if (\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1 &&
   Session::get('locale', Config::get('app.locale')) == 'ir')
                                                <label class="form-label"
                                                       style="color: #000d80;margin-top:13px;margin-right:-1px;display:block;width:190px;">{{ translate('renew time?') }}
                                                </label>
                                            @else
                                                <label class="form-label"
                                                       style="color: #000d80;margin-top:13px;margin-right:-30px;display:block;width:190px;">{{ translate('renew time?') }}
                                                </label>
                                            @endif
                                            <span class="input-group-text"><i class="las la-calendar"
                                                                              style="color:#00bbf2;font-size: 18px;"></i></span>
                                            <input dir="ltr" type="text" class="form-control aiz-date-range"
                                                   name="updatetimeRangelink_{{ $keymember }}"
                                                   style="width:280px;"
                                                   value="{{ $start_date && $end_date ? $start_date . ' to ' . $end_date : '' }}"
                                                   placeholder="{{translate('Select Date')}}" data-time-picker="true"
                                                   data-format="DD-MM-Y HH:mm:ss" data-separator=" to "
                                                   autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-warning" role="alert">
                                    <p style="font-size:14px">{{ translate('Note: There must be at least one link to share. If you want to disable the link for any reason,')}}</p>
                                    <p style="font-size:14px">{{ translate('you can change the date to before today or change the download password')}}</p>
                                    <p style="font-size:14px">{{ translate('so that the files cannot be downloaded by changing the information.')}}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ translate('Cancel') }}</button>
                                    <button type="submit"
                                            class="btn btn-primary">{{translate('Save Shared Link Configuration')}}</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    {{--    //check backup file and folder permission--}}
    <div class="modal fade" id="checkPermission" tabindex="-1" role="dialog" aria-labelledby="checkPermission"
         aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ translate('File And Folder Permission') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>{{ translate('File or Folder') }}</th>
                            <th>{{ translate('Status') }}</th>
                        </tr>
                        </thead>
                        @php
                            $required_paths = ['databasebackups','databasebackups/backup.json', 'databasebackups/log','databasebackups/share','databasebackups/share/shares.json', base_path(), '.env',  'public', 'app/Providers', 'app/Http/Controllers', 'storage', 'resources/views']
                        @endphp
                        <tbody>
                        @foreach ($required_paths as $path)
                            <tr>
                                <td>{{ $path }}</td>
                                <td>
                                    @if(is_writable(base_path($path)))
                                        <i class="las la-check-circle la-2x text-success"></i>
                                    @else
                                        <i class="las la-times-circle la-2x text-danger"></i>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ translate('Close') }}</button>
                    </div>

                </div>
            </div>
        </div>

    </div>

    {{--    //log activity section--}}
    <div class="modal fade" id="logsettings" tabindex="-1" role="dialog"
         aria-labelledby="logsettings" aria-hidden="true">
        <div class="modal-body">

            {{--            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">--}}
            <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-xls">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ translate('Statistics') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <strong>{{ translate('actions') }}</strong>
                                </div>
                                <div class="card-body">

                                    <div style="height:500px; overflow-y: scroll;">

                                        <table id="LogTable" class="display table table-striped table-bordered StandardTable"
                                               width="100%">
                                            <thead { display:block; }>
                                            <tr>
                                                <th scope="ro">#</th>
                                                <th><span class="sorta">{{ translate('day') }}</span></th>
                                                <th><span>hh:mm:ss</span></th>
                                                <th><span class="sorta">{{ translate('user') }}</span></th>
                                                <th><span class="sorta">{{ translate('action') }}</span></th>
                                                <th><span class="sorta">{{ translate('type') }}</span></th>
                                                <th><span class="sorta">{{ translate('item') }}</span></th>
                                            </tr>
                                            </thead>
                                            <tbody { height:300px; overflow-y:scroll; display:block; }>

                                            <?php
                                            $logdir = base_path('databasebackups/log');

                                            $loglist = glob($logdir . "/*.json");
                                            $loglist = $loglist ? $loglist : array();
                                            $loglist = array_reverse(array_values(preg_grep('/^([^.])/', $loglist)));
                                            $range = 1;
                                            $logs = array_slice($loglist, 0, $range);
                                            $result = array();
                                            foreach ($logs as $log) {
                                                $logfile = base_path('databasebackups/log/') . basename($log);
                                                if (file_exists($logfile)) {
                                                    $resultnew = json_decode(file_get_contents($logfile), true);
                                                    $result = $resultnew ? array_merge($result, $resultnew) : array();
                                                }
                                            }
                                            $numdown = 0;

                                            $polardowncount = 0;
                                            $polarplaycount = 0;
                                            $polarupcount = 0;

                                            $labelsarray = array();
                                            $downloaddataset = array();


                                            $time_format = 'Y/m/d - H:i';
                                            $formatdate = substr($time_format, 0, 5);

                                            foreach ($result as $key => $value) {
                                                $listtime = strtotime($key);
                                                $showtime = date($formatdate, $listtime);
                                                $labelsarray[] = $showtime;
                                                $downloads = 0;
                                                $rownumberx = 0;
                                            foreach ($value as $kiave => $day) {
                                                $rownumberx++;
                                                $contextual = "";
                                                $item = str_replace('\\\'', '\'', $day['item']);
                                                if ($day['action'] == 'DOWNLOAD') {
                                                    $downloads++;
                                                    $numdown++;
                                                    $polardowncount++;
                                                }
                                                ?>
                                            <tr class="table stripped">
                                                <td><?php echo $rownumberx; ?></td>
                                                <td><?php echo $showtime; ?></td>
                                                <td><?php echo $day['time']; ?></td>
                                                <td><?php echo $day['user']; ?></td>
                                                <td><?php echo strtolower($day['action']); ?></td>
                                                <td><?php echo $day['type']; ?></td>
                                                <td class="text-nowrap"><?php echo $item; ?></td>
                                                <?php
                                            }
                                                array_push($downloaddataset, $downloads);
                                            }
                                            $downloaddataset = array_reverse($downloaddataset);
                                            $labelsarray = array_reverse($labelsarray);
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{--    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

@endsection


@section('modal')
    <div class="modal fade" id="share_files_modal" tabindex="-1" role="dialog"
         aria-labelledby="sharefilesmodalxx" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg  modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ translate('Confirm Share') }}</h5>
                    <button type="button"  onclick="javascript:window.location.reload()" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-info" role="alert">
                    <b>{{ translate('Do you really want to share this backup?') }}</b>
                </div>

                <div class="modal-body">

                    <div class="createlink-wrap mb-3">
                        <div class="d-grid gap-2">
                            <button id="createlink" class="btn btn-info">
                                <i class="las la-check-circle"></i> {{ translate('Generate link') }}
                            </button>
                        </div>
                    </div>


                    <div class="form-group shalink mb-3">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a class="btn btn-info sharebutt" href="#" target="_blank" style="height:42px;"><i
                                            class="las la-link"></i></a>
                            </span>
                            <input dir="ltr" id="copylink" class="sharelink form-control" type="text"
                                   onclick="this.select()"
                                   readonly>
                            <span class="input-group-btn">
                                    <button onclick="copyToClipBoard();" id="clipme" class="clipme btn btn-info"
                                            data-bs-toggle="popover" data-bs-placement="bottom"
                                            data-bs-content=" {{ translate('copied') }}"
                                            data-clipboard-target="#copylink" style="height:42px;">
                                        <i class="las la-clipboard-check"></i>
                                    </button>
                                </span>
                        </div>
                    </div>


                    {{--                <div class="form-group row">--}}
                    {{--                    <div class="col-md-4">--}}
                    {{--                        <label class="col-from-label"--}}
                    {{--                        style="color:#000d80;margin-right:10px; text-align:left;height:20px; overflow:hidden; float:left;">{{ translate('Password protected') }}</label>--}}
                    {{--                        <i class="las la-key la-2x"></i>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="col-md-8">--}}
                    {{--                        <input type="checkbox" role="switch" name="use_pass" id="use_pass"--}}
                    {{--                               style="margin-left:-65px; margin-right:-65px; text-align:left;height:18px;">--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}
                    <div class="form-group row">
                        <div class="col-md-10">
                            <div class="input-group">

                                @if (\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1 &&
    Session::get('locale', Config::get('app.locale')) == 'ir')
                                    <label class="form-label"
                                           style="color: #000d80;margin-top:13px;margin-right:-1px;display:block;width:190px;">{{ translate('Password protected') }}
                                        :</label>
                                @else
                                    <label class="form-label"
                                           style="color: #000d80;margin-top:13px;margin-right:10px;display:block;width:150px;">{{ translate('Password protected') }}
                                        :</label>
                                @endif
                                <input type="checkbox" role="switch" name="use_pass" id="use_pass"
                                       style="background-color: #00bbf2; margin-left:35px; margin-right:5px; margin-top:15px; text-align:left;height:18px;">
                            </div>
                        </div>
                    </div>


                    <div class="form-group seclink mb-3">
                        <div class="input-group">
                            <label class="form-label"
                                   style="color: #000d80;margin-top:13px;margin-right:5px;display:block;width:190px;">{{ translate('random password') }}
                                : </label>
                            {{--                            <span class="input-group-text" onclick="copyToClipBoard();"><i class="las la-lock-open"></i></span>--}}

                            <a href="#" onclick='copyToClipBoard3();'
                               class="btn btn-info service-btn d-flex align-items-center justify-content-center"><i
                                        style="width:0.65rem; height:1.0rem;"
                                        class="las la-lock-open"></i></a>


                            <input class="form-control passlink setpass" type="text" onclick="this.select()"
                                   placeholder="{{ translate('random password') }}">
                        </div>
                    </div>


                    <?php $advancechecked = $advance_download ? ' checked' : ''; ?>
                    {{--                <div class="form-group row">--}}
                    {{--                    <div class="col-md-4">--}}
                    {{--                        <label class="col-from-label"--}}
                    {{--                        style="color:#000d80;margin-right:10px; text-align:left;height:20px; overflow:hidden; float:left;">{{ translate('advance file selection') }}</label>--}}
                    {{--                        <i class="las la-file la-2x"></i>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="col-md-8">--}}
                    {{--                        <input type="checkbox" role="switch" name="use_advance" id="use_advance"--}}
                    {{--                               onchange="update_advance(this)"--}}
                    {{--                               style="margin-left:-65px; margin-right:-65px; text-align:left;height:18px;"--}}
                    {{--                            <?php echo $advancechecked; ?>>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}
                    <div class="form-group row">
                        <div class="col-md-10">
                            <div class="input-group">

                                @if (\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1 &&
    Session::get('locale', Config::get('app.locale')) == 'ir')
                                    <label class="form-label"
                                           style="color: #000d80;margin-top:13px;margin-right:-1px;display:block;width:190px;">{{ translate('advance file selection') }}
                                        :</label>
                                @else
                                    <label class="form-label"
                                           style="color: #000d80;margin-top:13px;margin-right:10px;display:block;width:150px;">{{ translate('advance file selection') }}
                                        :</label>
                                @endif
                                <input type="checkbox" role="switch" name="use_advance" id="use_advance"
                                       onchange="update_advance(this)"
                                       style="background-color: #00bbf2; margin-left:35px; margin-right:5px; margin-top:15px; text-align:left;height:18px;"
                                    <?php echo $advancechecked; ?>>
                            </div>
                        </div>
                    </div>


                    <div class="backup-choose-listxx" id="backup-choose-listxx">
                    </div>


                    @php
                        $start_date = date('d-m-Y H:i:s', strtotime(Carbon\Carbon::now()));
                        $end_date   = date('d-m-Y H:i:s', strtotime(Carbon\Carbon::now())+86400);

                    @endphp

                    {{--                <div class="form-group row">--}}
                    {{--                    <div class="col-md-3">--}}
                    {{--                        <label class="col-form-label"--}}
                    {{--                        style="color:#000d80;margin-right:10px; text-align:left;height:20px; overflow:hidden; float:left;">{{ translate('Keep links valid for') }}</label>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="col-md-9">--}}
                    {{--                        <div class="input-group">--}}
                    {{--                                <span class="input-group-text"><i class="las la-calendar"--}}
                    {{--                                                                  style="color:#00bbf2;font-size: 18px;"></i></span>--}}
                    {{--                            <input dir="ltr" type="text" class="form-control aiz-date-range"--}}
                    {{--                                   name="createtimeRangelink" id="createtimeRangelink"--}}
                    {{--                                   style="width:280px;"--}}
                    {{--                                   value="{{ $start_date && $end_date ? $start_date . ' to ' . $end_date : '' }}"--}}
                    {{--                                   placeholder="{{translate('Select Date')}}" data-time-picker="false"--}}
                    {{--                                   data-format="DD-MM-Y HH:mm:ss" data-separator=" to "--}}
                    {{--                                   autocomplete="off">--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}

                    {{--                <div class="form-group row">--}}
                    {{--                    <div class="col-md-10">--}}
                    {{--                        <div class="input-group">--}}

                    {{--                            @if (\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1 &&--}}
                    {{--Session::get('locale', Config::get('app.locale')) == 'ir')--}}
                    {{--                                <label class="form-label"--}}
                    {{--                                       style="color: #000d80;margin-top:13px;margin-right:-1px;display:block;width:190px;">{{ translate('Keep links valid for') }}--}}
                    {{--                                    :</label>--}}
                    {{--                            @else--}}
                    {{--                                <label class="form-label"--}}
                    {{--                                       style="color: #000d80;margin-top:13px;margin-right:10px;display:block;width:150px;">{{ translate('Keep links valid for') }}--}}
                    {{--                                    :</label>--}}
                    {{--                            @endif--}}
                    {{--                                <span class="input-group-text"><i class="las la-calendar"--}}
                    {{--                                                                  style="color:#00bbf2;font-size: 18px;"></i></span>--}}
                    {{--                                <input dir="ltr" type="text" class="form-control aiz-date-range"--}}
                    {{--                                       name="createtimeRangelink" id="createtimeRangelink"--}}
                    {{--                                       style="background-color: #00bbf2; margin-left:35px; margin-right:5px; margin-top:15px; text-align:left;height:18px;"--}}
                    {{--                                       value="{{ $start_date && $end_date ? $start_date . ' to ' . $end_date : '' }}"--}}
                    {{--                                       placeholder="{{translate('Select Date')}}" data-time-picker="false"--}}
                    {{--                                       data-format="DD-MM-Y HH:mm:ss" data-separator=" to "--}}
                    {{--                                       autocomplete="off">--}}

                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}



                    <div class="form-group mb-3">
                        <div class="input-group">
                            <label class="form-label"
                                   style="color: #000d80;margin-top:13px;margin-right:5px;display:block;width:190px;">{{ translate('Keep links valid for') }}
                                : </label>
                            {{--                            <span class="input-group-text" onclick="copyToClipBoard();"><i class="las la-lock-open"></i></span>--}}

                            {{--                        <a href="#" onclick='copyToClipBoard3();'--}}
                            {{--                           class="btn btn-info service-btn d-flex align-items-center justify-content-center"><i--}}
                            {{--                                style="width:0.65rem; height:1.0rem;"--}}
                            {{--                                class="las la-lock-open"></i></a>--}}

                            {{--                        <span class="input-group-text">--}}
                            {{--                            <i class="las la-calendar"--}}
                            {{--                               style="color:#00bbf2;font-size: 18px;width:0.65rem; height:1.0rem;">--}}
                            {{--                            </i>--}}
                            {{--                        </span>--}}
                            <span class="input-group-text"><i class="las la-calendar"
                                                              style="color:#00bbf2;font-size: 18px;"></i></span>


                            {{--                        <input class="form-control passlink setpass" type="text" onclick="this.select()"--}}
                            {{--                               placeholder="{{ translate('random password') }}">--}}


                            <input dir="ltr" type="text" class="form-control aiz-date-range"
                                   name="createtimeRangelink" id="createtimeRangelink"
                                   {{--                               style="width:280px;"--}}
                                   value="{{ $start_date && $end_date ? $start_date . ' to ' . $end_date : '' }}"
                                   placeholder="{{translate('Select Date')}}" data-time-picker="true"
                                   data-format="DD-MM-Y HH:mm:ss" data-separator=" to "
                                   autocomplete="off">




                        </div>
                    </div>









                    <?php $formchecked = $one_time_download ? ' checked' : ''; ?>
                    {{--                <div class="form-group row">--}}
                    {{--                    <div class="col-md-4">--}}
                    {{--                        <label class="col-from-label"--}}
                    {{--                               style="color: #000d80;margin-top:-40px;">{{ translate('One-time download') }}</label>--}}
                    {{--                        style="color:#000d80;margin-right:10px; text-align:left;height:20px; overflow:hidden; float:left;">{{ translate('One-time download') }}</label>--}}
                    {{--                        <i class="las la-download la-2x"></i>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="col-md-8">--}}
                    {{--                        <input type="checkbox" name="onetime" id="onetime" onchange="update_onetime(this)"--}}
                    {{--                               style="margin-left:-65px; margin-right:-65px; text-align:left;height:18px;" <?php echo $formchecked; ?>>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}
                    <div class="form-group row">
                        <div class="col-md-10">
                            <div class="input-group">

                                @if (\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1 &&
    Session::get('locale', Config::get('app.locale')) == 'ir')
                                    <label class="form-label"
                                           style="color: #000d80;margin-top:13px;margin-right:-1px;display:block;width:190px;">{{ translate('One-time download') }}
                                        :</label>
                                @else
                                    <label class="form-label"
                                           style="color: #000d80;margin-top:13px;margin-right:10px;display:block;width:150px;">{{ translate('One-time download') }}
                                        :</label>
                                @endif

                                <input type="checkbox" name="onetime" id="onetime" onchange="update_onetime(this)"
                                       style="background-color: #00bbf2; margin-left:35px; margin-right:5px; margin-top:15px; text-align:left;height:18px;"
                                    <?php echo $formchecked; ?>>

                            </div>
                        </div>
                    </div>


                    <div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    </div>

                    <div class="text-center">

                        @if (env('MAIL_USERNAME') != null)

                            <a class="openmail fs-1 btn btn-info my-3" data-toggle="modal"
                               data-target="#frm_sendlinktoemail"
                               href="#!">
                                <i class="las la-envelope-open-text la-3x"></i>
                            </a>

                        @else

                            <div style="color: #ff4d00;background-color:#ffc405;border-color:#f6a662;margin-left: 1rem; margin-right: 1rem;"
                                 class="alert alert-warning" role="alert">
                                <b>{{ translate('Please configure SMTP first') }}</b>
                            </div>

                            <a class="disabled openmail fs-1 btn btn-warning my-3" data-toggle="modal"
                               data-target="#frm_sendlinktoemail"
                               href="#!">
                                <i class="las la-envelope-open-text la-3x"></i>
                            </a>

                        @endif

                    </div>

                    <form role="form" id="frm_sendlinktoemail" action="{{ route('backups.sendfilestoemail') }}"
                          method="POST" class="collapse">
                        @csrf
                        {{--                        <input type="hidden" name="key" value="{{ $key }}"/>--}}
                        {{--                        <input type="hidden" name="backuptype" value="{{ $backup['type'] }}"/>--}}
                        <input type="hidden" name="backupnames" value=""/>
                        <input type="hidden" name="timeupto" value=""/>

                        <div class="mailresponse"></div>

                        {{-- language --}}
                        @php
                            if(Session::has('locale')){
                                $locale = Session::get('locale', Config::get('app.locale'));
                            }
                            else{
                                $locale = env('DEFAULT_LANGUAGE');
                            }

                        @endphp

                        <input name="thislang" type="hidden" value="{{ $locale }}">

                        <div class="input-group mb-3">
                            <label class="form-label" for="mitt"
                                   style="color: #000d80;margin-top:13px;margin-right:5px;display:block;width:100px;">{{ translate('from') }}
                                : </label>
                            <span class="input-group-text"><i class="las la-user"></i></span>
                            {{--                                    <input name="mitt" type="email" class="form-control" id="mitt" value="<?php echo $gateKeeper->getUserInfo('email'); ?>" placeholder="{{ translate('Your E-mail') }}" required>--}}
                            <input dir="ltr" name="mitt" type="email" class="form-control" id="mitt"
                                   value="{{ Auth::user()->email ?? '' }}"
                                   placeholder="{{ translate('Your E-mail') }}" required>
                        </div>

                        <div class="wrap-dest">
                            <div class="input-group mb-3">
                                <label class="form-label" for="dest"
                                       style="color: #000d80;margin-top:13px;margin-right:5px;display:block;width:100px;">{{ translate('Send to') }}
                                    : </label>
                                <span class="input-group-text"><i class="las la-envelope"></i></span>
                                {{--                                    <input name="mitt" type="email" class="form-control" id="mitt" value="<?php echo $gateKeeper->getUserInfo('email'); ?>" placeholder="{{ translate('Your E-mail') }}" required>--}}
                                <input dir="ltr" name="dest" type="email" class="form-control addest" id="dest"
                                       {{--                                       value="{{ Auth::user()->email ?? '' }}"--}}
                                       value="kia1349@gmail.com"
                                       placeholder="{{ translate('Destination E-mail') }}" required>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <div class="btn btn-primary btn-xs shownext hidden">
                                <i class="las la-user-plus la-2x"></i>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <textarea class="form-control" name="message" id="mess" rows="3"
                                      placeholder="{{ translate('message') }}"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <div class="d-grid gap-2">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-info"><i class="las la-envelope la-2x"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <input name="lifetimelink" id="lifetimelink" class="form-control lifetimelink" type="hidden"/>
                        <input name="onetimecheck" id="onetimecheck" class="form-control onetimecheck" type="hidden"/>
                        <input name="passlink" class="form-control passlink" type="hidden">
                        <input name="sharelink" class="sharelink" type="hidden">
                        <input name="secretlink" class="secretlink" type="hidden">
                    </form>



                    {{--                    <div id="PersianGulf_restoreBackupxx_{{ $backupxx['klid'] }}"></div>--}}
                    <div style="display:none;" id="PersianGulf_ShareBackup" class="currently-loading">
                    </div>



                </div>

            </div>
        </div>
    </div>

@endsection





@section('script')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css"/>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    {{--    <script src="//cdn.datatables.net/plug-ins/2.0.0/i18n/fa.json"></script>--}}
    <script>
        // var Globaldiv = null;
        // var frm_downloadBackup_key = null;
        // var div_downloadBackup_key = null;
        // var div_downloadBackup_element = null;
        //
        var frm_restoreBackup_key = null;
        var div_restoreBackup_key = null;
        var div_restoreBackup_element = null;


        function show_share_modal(id){
            $.post('{{ route('backups.share_modal') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
                // $('#share_files_modal #modal-contentxx').html(data);
                $('#share_files_modal #backup-choose-listxx').html(data);
                show_animation_shareBackup();
                show_share_frmxx(id);
                $('#share_files_modal').modal('show', {backdrop: 'static'});
                AIZ.plugins.bootstrapSelect('refresh');
            });
        }

        //close side bar menu when form loaded
        $(document).ready(function () {
            $('body').addClass('side-menu-closed');

            // Activate tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();


            //PAGINATE SHARED LINK
            //use with default settings
            // https://datatables.net/plug-ins/i18n/Spanish
            //https://cdn.datatables.net/plug-ins/2.0.0/i18n/
            //https://datatables.net/plug-ins/i18n/

            //use this with custom settings for show entries
            if ( $("html:lang(ir)").length > 0 && $("html").attr("lang") === 'ir') {
                new DataTable('#ShareTable', {
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, 'All']
                    ],
                    pagingType: 'full_numbers',
                    language: {
                        url: '//cdn.datatables.net/plug-ins/2.0.0/i18n/fa.json',
                    },
                });
            } else {
                new DataTable('#ShareTable', {
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, 'All']
                    ],
                    pagingType: 'full_numbers'
                });
            }

            //use this with custom settings for show activity logs
            if ( $("html:lang(ir)").length > 0 && $("html").attr("lang") === 'ir') {
                new DataTable('#LogTable', {
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, 'All']
                    ],
                    pagingType: 'full_numbers',
                    language: {
                        url: '//cdn.datatables.net/plug-ins/2.0.0/i18n/fa.json',
                    },
                });
            } else {
                new DataTable('#LogTable', {
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, 'All']
                    ],
                    pagingType: 'full_numbers'
                });
            }

            //use this with custom settings for show activity logs
            if ( $("html:lang(ir)").length > 0 && $("html").attr("lang") === 'ir') {
                new DataTable('#BackUpTablexx', {
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, 'All']
                    ],
                    pagingType: 'full_numbers',
                    language: {
                        url: '//cdn.datatables.net/plug-ins/2.0.0/i18n/fa.json',
                    },
                });
            } else {
                new DataTable('#BackUpTablexx', {
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, 'All']
                    ],
                    pagingType: 'full_numbers',

                });
            }

            //reset advance table selection checkbox to uncheck when form refreshed
            var adv_check = document.getElementById('advcheck');
            var ch_btnx = adv_check.querySelector('input');
            ch_btnx.checked = false;

            $("#sharefilesmodal").on('hide.bs.modal', function () {
                $('#onetime').prop('checked', false);
                $('#use_pass').prop('checked', false);
                $('#lifetime').removeAttr('disabled');


                //reza new
                $('#use_advance').prop('checked', false);
                //reza new


                $('#lifetime').val("1");
                $('#lifetimelink').val("1");
                $('#onetime').val("0");
                $('#onetimecheck').val("0");
                // $('#onetime').prop('checked', false);
            });
        });

        //////////////////// show animation progressbar for create backup,download backup,restore backup and sending share link to email
        function show_animation_createBackup() {
            var frm_createBackupxx = document.getElementById('frm_createBackupxx');
            frm_createBackupxx.addEventListener('submit', bmdLoading1);
        }
        function bmdLoading1() {
            var mydiv = document.getElementById("PersianGulf_CreateBackup");
            mydiv.style.display = (mydiv.style.display !== "none") ? "none" : "block";
        }

        function show_animation_restoreBackup(e) {
            frm_restoreBackup_key = 'frm_restoreBackupxx_' + e;
            frm_restoreBackup = document.getElementById(frm_restoreBackup_key);
            // console.log(frm_restoreBackup)
            div_restoreBackup_key = 'PersianGulf_RestoreBackup_' + e;
            // Globaldiv = document.getElementById(div_restoreBackup_key);
            // div_restoreBackup_element = '#PersianGulf_RestoreBackup_' + e;
            // console.log(Globaldiv)
            // console.log(div_restoreBackup_key)
            // console.log(div_restoreBackup_element)
            frm_restoreBackup.addEventListener('submit', bmdLoading2);

        }
        function bmdLoading2() {
            divloading2 = '<div class="currently-loading"></div>'
            var mydiv = document.getElementById(div_restoreBackup_key);
            mydiv.style.display = (mydiv.style.display !== "none") ? "none" : "block";
        }

        function show_animation_shareBackup() {
            var frm_shareBackupxx = document.getElementById('frm_sendlinktoemail');
            frm_shareBackupxx.addEventListener('submit', bmdLoading3);
            console.log("set animation for send share link");
        }
        function bmdLoading3() {
            console.log("run animation for send share link");
            var mydiv = document.getElementById("PersianGulf_ShareBackup");
            mydiv.style.display = (mydiv.style.display !== "none") ? "none" : "block";
        }


        // var thisIsGlobalForm = null;
        //
        // //////////////////////////////////////////
        // //progress animation for download backups
        // var GlobalForm_downloadBackup = null;
        // var GlobalDiv_downloadBackup = null;
        // var  thisIsGlobalSelect = null;
        // function show_animation_downloadBackupxx(e) {
        //     var frm_downloadBackup_key = '';
        //     frm_downloadBackup_key = 'frm_downloadBackupxx_' + e;
        //     // e.preventDefault();   // use this to NOT go to href site
        //     var frm_downloadBackupxx = '';
        //     frm_downloadBackupxx = document.getElementById(frm_downloadBackup_key);
        //     GlobalForm_downloadBackup = document.getElementById(frm_downloadBackup_key);
        //     GlobalForm_downloadBackup.addEventListener('submit', downloadBackupxx);
        //     GlobalDiv_downloadBackup = '#PersianGulf_downloadBackupxx_' + e;
        //     console.log(e);
        //     console.log(GlobalForm_downloadBackup);
        //     console.log(GlobalDiv_downloadBackup);
        //     // console.log(($(GlobalDiv_downloadBackup).length > 0).toString() + '       ' + GlobalDiv_downloadBackup)
        //     // console.log($(GlobalDiv_downloadBackup))
        //
        // }



        //display loading message
        function bmdLoading99() {
            // var divloading2 = '';
            // divloading2 = '<div class="currently-loading"></div>'

            divloading2x ='<ul class="cssload-cssload-ballsncups">'
            divloading2x +='<li>'
            divloading2x +='<div class="cssload-circle"></div>'
            divloading2x +='<div class="cssload-ball"></div>'
            divloading2x +='</li>'
            divloading2x +='<li>'
            divloading2x +='<div class="cssload-circle"></div>'
            divloading2x +='<div class="cssload-ball"></div>'
            divloading2x +='</li>'
            divloading2x +='<li>'
            divloading2x +='<div class="cssload-circle"></div>'
            divloading2x +='<div class="cssload-ball"></div>'
            divloading2x +='</li>'
            divloading2x +='<li>'
            divloading2x +='<div class="cssload-circle"></div>'
            divloading2x +='<div class="cssload-ball"></div>'
            divloading2x +='</li>'
            divloading2x +='<li>'
            divloading2x +='<div class="cssload-circle"></div>'
            divloading2x +='<div class="cssload-ball"></div>'
            divloading2x +='</li>'
            divloading2x +='<li>'
            divloading2x +='<div class="cssload-circle"></div>'
            divloading2x +='<div class="cssload-ball"></div>'
            divloading2x +='</li>'
            divloading2x +='<li>'
            divloading2x +='<div class="cssload-circle"></div>'
            divloading2x +='<div class="cssload-ball"></div>'
            divloading2x +='</li>'
            divloading2x +='<li>'
            divloading2x +='<div class="cssload-circle"></div>'
            divloading2x +='<div class="cssload-ball"></div>'
            divloading2x +='</li>'
            divloading2x +='</ul>'

            $("#PersianGulf_createBackupxx").html(divloading2x);
            $("#createBackupxx #PersianGulf_createBackupxx").html(divloading2x);



            // $(thisIsGlobalDiv).html(divloading2x);
        }





        // function show_animation(e) {
        //     // console.log(e);
        //     var nn = 'frm_restore_' + e;
        //     // e.preventDefault();   // use this to NOT go to href site
        //     var frm_restorex = document.getElementById(nn);
        //     thisIsGlobalForm = document.getElementById(nn);
        //     console.log(frm_restorex);
        //     thisIsGlobalForm.addEventListener('submit', bmdLoading2);
        //     thisIsGlobalDiv = '#PersianGulfRestore_' + e;
        // }
        //
        // function show_animationxx(e) {
        //     // console.log(e);
        //     var nnxx = 'frm_restoreBackupxx_' + e;
        //     // e.preventDefault();   // use this to NOT go to href site
        //     var frm_restoreBackupx = document.getElementById(nnxx);
        //     thisIsGlobalForm = document.getElementById(nnxx);
        //     console.log(frm_restoreBackupx);
        //     thisIsGlobalForm.addEventListener('submit', bmdLoading2);
        //     thisIsGlobalDiv = '#PersianGulf_restoreBackupxx_' + e;
        // }

        //if clicked on #ch_all, check all tables in .ch_tables
        var ch_all = document.getElementById('ch_all');
        if (ch_all) {
            var ch_btn = ch_all.querySelector('input');
            var tables = document.querySelectorAll('#frm_cht .ch_tables input');
            ch_all.addEventListener('click', function () {
                if (tables) {
                    for (var i = 0; i < tables.length; i++) tables[i].checked = ch_btn.checked;
                    // update_all_status();
                }
            });
        }

        function update_status(el, tablecount) {
            var arrayx = [];
            // if (el.checked) {
            //     var status = 1;
            // } else {
            //     var status = 0;
            // }
            var tables = document.querySelectorAll('#frm_cht .ch_tables input');
            for (var n = 0; n < tables.length; n++) {
                if (tables[n].checked) {
                    arrayx.push(tables[n].value)
                }
            }
            $('input[type=hidden][name="checkboxeslist"]').val(JSON.stringify(arrayx));

            console.log(arrayx);
            console.log(tablecount + ' <> ' + arrayx.length);

            var baba = '';
            if (tablecount === arrayx.length) {
                baba = '<h3 style="color: #cc2e2e">There are no tables to backup</h3>';
            } else {
                if (arrayx.length > 0) {
                    baba = '<h3 style="color: #e7a042">A number of tables have been selected for exclude from backup</h3>';
                } else {
                    baba = '<h3 style="color: #04a111">all tables have been selected for backup</h3>';
                }
            }
            $("#persian").html(baba);

            console.log($("input[id=checkboxeslistzz]").val());
        }

        function update_all_status(tablecount) {
            // const tablecount=104;
            var arrayx = [];
            var tables = document.querySelectorAll('#frm_cht .ch_tables input');
            for (var n = 0; n < tables.length; n++) {
                if (tables[n].checked) {
                    arrayx.push(tables[n].value)
                }
            }
            $('input[type=hidden][name="checkboxeslist"]').val(JSON.stringify(arrayx));

            console.log(arrayx);
            console.log(tablecount + ' <> ' + arrayx.length);

            var baba = '';
            if (tablecount === arrayx.length) {
                baba = '<h3 style="color: #cc2e2e">There are no tables to backup</h3>';
            } else {
                if (arrayx.length > 0) {
                    baba = '<h3 style="color: #e7a042">A number of tables have been selected for exclude from backup</h3>';
                } else {
                    baba = '<h3 style="color: #04a111">all tables have been selected for backup</h3>';
                }
            }
            $("#persian").html(baba);


            console.log($("input[id=checkboxeslistzz]").val());
        }

        function show_hide_selection(el) {
            if (el.checked) {
                $("#table_selection").show();
            } else {
                $("#table_selection").hide();
            }
        }


        //share section *************************************

        /**
         * Send link via e-mail
         */
        var AECmodals = '<?php echo json_encode($AECmodals); ?>';
        var AECmodals = JSON.parse(AECmodals);
        var thisIsGlobalFormShare = null;
        var selectedfiles = [];
        var backupnames = null;
        var thisIsGlobalFormShareLink = null;


        function show_share_frm(e, ke, many, msg) {

            var farnaz_id = '';
            farnaz_id = 'shareId_' + e;
            console.log('farnaz_id=>' + farnaz_id + '    ' + e)

            ccccc = document.getElementById(farnaz_id);
            console.log('ccccc=>' + ccccc)
            // let rowid = '0';
            var rowid = '';
            rowid = $(ccccc).attr('data-id');
            console.log('rowid=>' + rowid)
            $('#dataid').text($(this).data('id'));
            $('#dataid').text(rowid);
            thisIsGlobalSelect = rowid;

            // $.session.clear();
            // $.session.set('rowid', rowid);


            $('input[name="backupnames"]').val(e);
            var wichform = 'sendfiles_' + e;
            var wichform2 = 'sharefilesmodal_' + e;
            backupnames = e;
            console.log('backupnames=>' + backupnames)
            thisIsGlobalFormShare = document.getElementById(wichform);

            $('#onetime').prop('checked', false);
            $('#use_pass').prop('checked', false);
            $('#lifetime').removeAttr('disabled');
            $('#lifetime').val("1");
            $('#lifetimelink').val("1");
            $('#onetime').val("0");
            $('#onetimecheck').val("0");
            // $('#onetime').prop('checked', false);

            //reza new
            //$('#use_advance').prop('checked', false);
            //reza new


            var numfiles = 2;
            console.log(numfiles);
            if (numfiles > 0) {

                // reset form
                // $('.addest').val('');
                $('.shownext').addClass('hidden');
                $('.bcc-address').remove();
                //
                $('.seclink, .shalink, .mailresponse, .openmail').hide();
                $('.seclink').hide();

                //reza new
                $('.backup-choose-listxx').hide();
                $('.backup_idsxx').val('');
                //reza new

                $('#xsendfiles').removeClass('in');
                $('.sharelink, .passlink, .secretlink').val('');
                $('.sharebutt').attr('href', '#');
                $('.createlink-wrap').fadeIn();
                //
                passwidget();
            } else {
                // alert($selectfiles);
            }

            {{--$.ajax({--}}
            {{--    cache: false,--}}
            {{--    type: "POST",--}}
            {{--    headers: {--}}
            {{--        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
            {{--    },--}}
            {{--    url: "{{ route('backups.beboos') }}",--}}
            {{--    data: {--}}
            {{--        bababa: rowid--}}
            {{--    }--}}
            {{--})--}}
            {{--    .done(function (msg) {--}}
            {{--        console.log(msg);--}}
            {{--        // $('#sharefilesmodalxx').modal('show', {backdrop: 'static'});--}}
            {{--        // show_share_frm(e, ke, many,msg);--}}
            {{--        // AIZ.plugins.bootstrapSelect('refresh');--}}
            {{--    })--}}
            {{--    .fail(function () {--}}
            {{--        console.log('create link does not work');--}}

            {{--    });--}}



            // $.ajax({
            //     type: "POST",
            //         headers: {
            //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //                 },
            //     data: { sweets: rowid },
            //     success: function(data) {
            //         // $("#test").html(data);
            //         console.log(data);
            //     }
            // });
            $('#sharefilesmodalxx').modal('show', {backdrop: 'static'});
            AIZ.plugins.bootstrapSelect('refresh');



        }

        function show_share_frmxx(e) {

            var farnaz_id = '';
            farnaz_id = 'shareId_' + e;
            console.log('farnaz_id=>' + farnaz_id + '    ' + e)

            ccccc = document.getElementById(farnaz_id);
            console.log('ccccc=>' + ccccc)
            // let rowid = '0';
            var rowid = '';
            rowid = $(ccccc).attr('data-id');
            console.log('rowid=>' + rowid)
            $('#dataid').text($(this).data('id'));
            $('#dataid').text(rowid);
            thisIsGlobalSelect = rowid;

            // $.session.clear();
            // $.session.set('rowid', rowid);


            $('input[name="backupnames"]').val(e);
            var wichform = 'sendfiles_' + e;
            var wichform2 = 'sharefilesmodal_' + e;
            backupnames = e;
            console.log('backupnames=>' + backupnames)
            thisIsGlobalFormShare = document.getElementById(wichform);

            $('#onetime').prop('checked', false);
            $('#use_pass').prop('checked', false);
            $('#lifetime').removeAttr('disabled');
            $('#lifetime').val("1");
            $('#lifetimelink').val("1");
            $('#onetime').val("0");
            $('#onetimecheck').val("0");
            // $('#onetime').prop('checked', false);

            //reza new
            $('#use_advance').prop('checked', false);
            //reza new


            var numfiles = 2;
            console.log(numfiles);
            if (numfiles > 0) {

                // reset form
                // $('.addest').val('');
                $('.shownext').addClass('hidden');
                $('.bcc-address').remove();
                //
                $('.seclink, .shalink, .mailresponse, .openmail').hide();
                $('.seclink').hide();

                //reza new
                $('.backup-choose-listxx').hide();
                $('.backup_idsxx').val('');
                //reza new

                $('#xsendfiles').removeClass('in');
                $('.sharelink, .passlink, .secretlink').val('');
                $('.sharebutt').attr('href', '#');
                $('.createlink-wrap').fadeIn();
                //
                passwidget();
            }
        }

        /**
         * file sharing password widget
         */
        function passwidget() {
            console.log("in the passwidget");
            if ($('#use_pass').prop('checked')) {
                $('.seclink').show();
            } else {
                $('.seclink').hide();
            }


            //reza new
            if ($('#use_advance').prop('checked')) {
                $('.backup-choose-listxx').show();
            } else {
                $('.backup-choose-listxx').hide();
            }
            //reza new


            $('.sharelink, .passlink, .secretlink').val('');
            $('.shalink, .openmail').hide();

            $('#sendfiles').removeClass('in');
            {{--$('#sendfiles_{{ $key }}').removeClass('in');--}}
            $('#wichform').removeClass('in');
            // thisIsGlobalFormShare.removeClass('in');


            $('.passlink').prop('readonly', false);
            $('.createlink-wrap').fadeIn();

            //reza new
            $('.backup_idsxx').prop('readonly', false);
            //reza new


        }

        $(document).on('change', '#use_pass', function () {
            $('.alert').alert('close');
            passwidget();
        });

        $(document).on('change', '#onetime', function () {
            $('.alert').alert('close');
            passwidget();
        });

        //reza new
        $(document).on('change', '#use_advance', function () {
            $('.alert').alert('close');
            passwidget();
        });

        //reza new


        /**
         * create a random string
         */
        function randomstring() {
            console.log("in the randomstring");
            var text = '';
            var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            for (var i = 0; i < 8; i++) {
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            }
            return text;
        }

        $(document).on('change', '.setlifetime', function () {
            lifetime = $('.setlifetime').val();
            console.log(lifetime);

            $('.shalink, .openmail').fadeOut('fast', function () {
                $('.createlink-wrap').fadeIn();
            })

        });


        $('#backup_idsxx').on('change', function(){

            console.log('backup_ids : ' + $('#backup_idsxx').val())
        });

        /**
         * Create sharable link
         */
        $(document).on('click', '#createlink', function () {
            // console.log("in the createlink1  backupnames=>"+backupnames);
            if (AECmodals.hasOwnProperty('share')) {
                var $insert4 = AECmodals.share.insert4,
                    $time = AECmodals.share.time,
                    $hash = AECmodals.share.hash,
                    $pulito = AECmodals.share.pulito;
            }
            var divar = selectedfiles;

            $('.alert').alert('close');
            var alertmess = '<div class="alert alert-warning alert-dismissible" role="alert">' + $insert4 + '</div>';
            var shortlink, passw, xlifetimelink, xonetimecheck, xbackupnames, xuseadvance;

            // xlifetimelink = $('#lifetime').val();
            xlifetimelink = 1;

            xonetimecheck = '';
            xonetimecheck = $('#onetimecheck').val();


            createtimeRangelink = new Date().getTime();
            createtimeRangelink = $('#createtimeRangelink').val();

            $('input[name="timeupto"]').val($('#lifetime').val());

            // check if wants a password
            if ($('#use_pass').prop('checked')) {
                if (!$('.setpass').val()) {
                    passw = randomstring();
                } else {
                    if ($('.setpass').val().length < 4) {
                        $('.setpass').focus();
                        $('.seclink').after(alertmess);
                        return;
                    } else {
                        passw = $('.setpass').val();
                    }
                }
            }


            //reza new
            // check if wants selectting backup files to share
            xuseadvance='0';
            var backup_ids = $('#backup_idsxx').val();
            console.log('backup_ids===> : ' + backup_ids + ' length=> ' + backup_ids.length);
            if ($('#use_advance').prop('checked')) {
                // if (!$('.backup_idsxx').val()) {
                //     backup_ids = $('.backup_idsxx').val();
                // } else {
                //     backup_ids = '';
                // }

                $("#use_advance").val("1");
                // const backup_ids = $('#advance_backup_idsxx').val();
                // var backup_ids = $('#advance_backup_idsxx').val();
                // var backup_ids = $('#backup_idsxx').val();
                // console.log('backup_ids===> : ' + backup_ids);
                // const xuseadvance = $('#use_advance').val();
                xuseadvance = $('#use_advance').val();
                console.log('xuseadvance : ' + xuseadvance);


            } else {
                $("#use_advance").val("0");
                // const backup_ids = '';
                // backup_ids = '0';
                // console.log('backup_ids : ' + backup_ids);
                // const xuseadvance = $('#use_advance').val();
                xuseadvance = $('#use_advance').val();
                console.log('xuseadvance : ' + xuseadvance);
            }


            {{--$.ajax({--}}
                    {{--    cache: false,--}}
                    {{--    type: "POST",--}}
                    {{--    headers: {--}}
                    {{--        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                    {{--    },--}}
                    {{--    url: "{{ route('backups.shorten') }}",--}}
                    {{--    data: {--}}
                    {{--        createtimeRangelink: createtimeRangelink,--}}
                    {{--        time: $time,--}}
                    {{--        hash: $hash,--}}
                    {{--        pass: passw,--}}
                    {{--        backupnames: backupnames,--}}
                    {{--        lifetime: xlifetimelink,--}}
                    {{--        onetime: xonetimecheck,--}}
                    {{--        // backupfilesid: backup_ids,--}}
                    {{--        backupfilesid: $('#backup_idsxx').val(),--}}
                    {{--        useadvance: xuseadvance--}}
                    {{--    }--}}
                    {{--})--}}

                    {{--.done(function (msg) {--}}
                    {{--    console.log('create link work done');--}}

                    {{--    shortlink = $pulito + '/backups/viewfilefromlink/' + msg;--}}
                    {{--    $('.secretlink').val(msg);--}}
                    {{--    $('.sharelink').val(shortlink);--}}
                    {{--    $('.sharebutt').attr('href', shortlink);--}}
                    {{--    $('.passlink').val(passw);--}}
                    {{--    $('.passlink').prop('readonly', true);--}}
                    {{--    $("#lifetimelink").val(xlifetimelink);--}}
                    {{--    // $("#onetimecheck").val(xonetimecheck);--}}
                    {{--    $("#onetimecheck").val(xonetimecheck).change();--}}

                    {{--    if ($('#onetime').is(":checked")) {--}}
                    {{--        $("#onetimecheck").val("1");--}}
                    {{--    } else {--}}
                    {{--        $("#onetimecheck").val("0");--}}
                    {{--    }--}}

                    {{--    $('.createlink-wrap').fadeOut('fast', function () {--}}
                    {{--        $('.shalink, .openmail').fadeIn();--}}
                    {{--    });--}}
                    {{--})--}}
                    {{--.fail(function () {--}}
                    {{--    console.log('create link does not work');--}}

                    {{--});--}}

            if (isNullOrUndefined(backup_ids)) {
                console.log("The value is either undefined or null");
                AIZ.plugins.notify('danger', "{{ translate('No files selected') }}");

            } else {
                $.post('{{ route('backups.shorten') }}', {_token:'{{ csrf_token() }}',
                    createtimeRangelink: createtimeRangelink,
                    time: $time,
                    hash: $hash,
                    pass: passw,
                    backupnames: backupnames,
                    lifetime: xlifetimelink,
                    onetime: xonetimecheck,
                    // backupfilesid: backup_ids,
                    backupfilesid: backup_ids,
                    useadvance: xuseadvance
                }, function(data){
                    console.log('create link work done');

                    shortlink = $pulito + '/backups/viewfilefromlink/' + data;
                    $('.secretlink').val(data);
                    $('.sharelink').val(shortlink);
                    $('.sharebutt').attr('href', shortlink);
                    $('.passlink').val(passw);
                    $('.passlink').prop('readonly', true);
                    $("#lifetimelink").val(xlifetimelink);
                    // $("#onetimecheck").val(xonetimecheck);
                    $("#onetimecheck").val(xonetimecheck).change();

                    if ($('#onetime').is(":checked")) {
                        $("#onetimecheck").val("1");
                    } else {
                        $("#onetimecheck").val("0");
                    }

                    $('.createlink-wrap').fadeOut('fast', function () {
                        $('.shalink, .openmail').fadeIn();
                    });
                });

                console.log("The value is neither undefined nor null");
                AIZ.plugins.notify('success', "{{ translate('Download Link Generated') }}");
            }

        });


        // // prevent form submitting with enter
        {{--$(document).on("keyup keypress", "#sendfiles_{{ $key }} :input:not(textarea)", function(event) {--}}
        $(document).on("keyup keypress", "#wichform :input:not(textarea)", function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
            }
        });

        function isNullOrUndefined(value) {
            return value === undefined || value === null || value === '' || value.length === 0;
        }

        function copyToClipBoard() {
            var linktext = document.getElementById('copylink').value
            navigator.clipboard.writeText(linktext);
            AIZ.plugins.notify('success', "{{ translate('Download Link Copied') }}");
        }

        function copyToClipBoard2(el, whichmember) {
            var linktext2 = document.getElementById('copylink2_' + whichmember).value
            // console.log("copy to clipboard 2  "+whichmember+"    "+linktext2)
            navigator.clipboard.writeText(linktext2);
            AIZ.plugins.notify('success', "{{ translate('Download Link Copied') }} ");
        }

        function copyToClipBoard3() {

            var linktext3 = $('.setpass').val();
            if (linktext3 === null || linktext3 === undefined || linktext3 === '') {
                AIZ.plugins.notify('warning', "{{ translate('Password Is Empty,You must enter a new password first') }}");
            } else {
                navigator.clipboard.writeText(linktext3);
                AIZ.plugins.notify('success', "{{ translate('Password Copied') }}");
            }
        }

        /**
         * Add mail recipients (file sharing)
         */
        $(document).on('click', '.shownext', function () {
            // var $lastinput = $(this).parent().prev().find('.form-group:last-child .addest');
            var $lastinput = $(this).parent().prev().find('.input-group:last-child .addest');

            if ($lastinput.val().length < 5) {
                $lastinput.focus();
            } else {
                var $newdest, $inputgroup, $addon1, $addon2, $input;

                $input = $('<input dir="ltr" name="send_cc[]" type="email" class="form-control addest">');
                $addon1 = $('<label class="form-label" style="color: #000d80;margin-top:13px;margin-right:5px;display:block;width:100px;"></label>');
                $addon2 = $('<span class="input-group-text"><i class="las la-envelope"></i></span>');
                $inputgroup = $('<div class="input-group"></div>').append($addon1).append($addon2).append($input);
                $newdest = $('<div class="form-group bcc-address mb-3"></div>').append($inputgroup);

                $('.wrap-dest').append($newdest);
            }
        });

        /**
         * Show additional recipients
         */
        $(document).on('input', '#dest', function () {
            if ($(this).val().length > 5) {
                $('.shownext').removeClass('hidden');
            } else {
                $('.shownext').addClass('hidden');
            }
        });

        function update_onetime(el) {
            // $('.alert').alert('close');
            // passwidget();

            if (el.checked) {
                $("#onetimecheck").val("1");
                $('#lifetime').attr('disabled', 'disabled');
            } else {
                $("#onetimecheck").val("0");
                $('#lifetime').removeAttr('disabled');
                console.log('unchecked unchecked aah aah aah aah aah aah1');
            }
        }

        function update_advance(el) {
            if (el.checked) {
                $("#use_advance").val("1");
                // $('#lifetime').attr('disabled', 'disabled');
            } else {
                $("#use_advance").val("0");
                // $('#lifetime').removeAttr('disabled');
            }
        }


        //*Works with Bootstrap v3 - v3.3.7 ===> i have 3.3.5
        function setModalMaxHeight(element) {
            this.$element = $(element);
            this.$content = this.$element.find('.modal-content');
            var borderWidth = this.$content.outerHeight() - this.$content.innerHeight();
            var dialogMargin = $(window).width() > 767 ? 60 : 20;
            var contentHeight = $(window).height() - (dialogMargin + borderWidth);
            var headerHeight = this.$element.find('.modal-header').outerHeight() || 0;
            var footerHeight = this.$element.find('.modal-footer').outerHeight() || 0;
            var maxHeight = contentHeight - (headerHeight + footerHeight);

            this.$content.css({
                'overflow': 'hidden'
            });

            this.$element
                .find('.modal-body').css({
                'max-height': maxHeight,
                'overflow-y': 'auto'
            });
        }

        $('.modal').on('show.bs.modal', function () {
            $(this).show();
            setModalMaxHeight(this);
        });

        $(window).resize(function () {
            if ($('.modal.in').length != 0) {
                setModalMaxHeight($('.modal.in'));
            }
        });


        function updatePassword(el, passid) {
            passw = randomstring();
            document.getElementById('updatepasslink_' + passid).value = passw
            AIZ.plugins.notify('success', '{{ translate('New Password Generated successfully') }}');
        }

        $('#share_files_modal').on('hidden.bs.modal', function () {
            location.reload();
        })

    </script>

@endsection

