@extends('layouts.body')

@section('title',"权限管理");
@section('name',"权限");

@section('content')
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="/plugins/iCheck/all.css">
    <?php
        echo power_check($menus,$menu_id);
    ?>
@endsection

@section('script')
    <!-- iCheck 1.0.1 -->
    <script src="/plugins/iCheck/icheck.min.js"></script>
   <script>
       $('input[type="checkbox"].flat-red').iCheck({
           checkboxClass: 'icheckbox_flat-green',
           radioClass   : 'iradio_flat-green'
       })
   </script>

@endsection

