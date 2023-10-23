@extends('backup::layouts.master')

@section('content')
    <h3>بکاپ های سامانه</h3>
    <div class="row">
        <div class="col-xs-12 clearfix">
            <a id="create-new-backup-button" href="{{ url('admin/backup/create') }}" class="btn btn-primary pull-right"
               style="margin-bottom:2em;"><i
                    class="fa fa-plus"></i> ایجاد پشتیبان
            </a>
        </div>
        <div class="col-xs-12">
            @if (count($backups))

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>فایل</th>
                        <th>انداز</th>
                        <th>زمان</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($backups as $backup)
                        <tr>
                            <td>{{ $backup['file_name'] }}</td>
                            <td>{{ humanFilesize($backup['file_size']) }}</td>
                            <td>
                                {{ get_time_ago($backup['last_modified']) }}
                            </td>
                            <td class="text-right">
                                <a class="btn btn-xs btn-default"
                                   href="{{ url('admin/backup/download/'.$backup['file_name']) }}"><i
                                        class="fa fa-cloud-download"></i> دانلود</a>
                                <a class="btn btn-xs btn-danger" data-button-type="delete"
                                   href="{{ url('admin/backup/delete/'.$backup['file_name']) }}"><i class="fa fa-trash-o"></i>
                                    حذف</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="well">
                    <h4>بکاپی موجود نیست</h4>
                </div>
            @endif
        </div>
    </div>
@stop

@php
    function humanFilesize($size, $precision = 2) {
        $units = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $step = 1024;
        $i = 0;

        while (($size / $step) > 0.9) {
            $size = $size / $step;
            $i++;
        }

        return round($size, $precision).$units[$i];
    }
    function get_time_ago ($time) // e.g. '2013-05-28 17:25:43'
    {

        $time = time() - $time; // to get the time since that moment

        $tokens = array (
        31536000 => 'سال',
        2592000 => 'ماه',
        604800 => 'هفته',
        86400 => 'روز',
        3600 => 'ساعت',
        60 => 'دقیقه',
        1 => 'ثانیه'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);

        return $numberOfUnits.' '.$text.' پیش';
    }

}
@endphp
