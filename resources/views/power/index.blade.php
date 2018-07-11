@extends('layouts.body')

@section('title',"权限管理");
@section('name',"权限");

@section('content')
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../../plugins/iCheck/all.css">
    <div class="form-group">
        <label>
            <input type="checkbox" class="flat-red" checked> test1
        </label>
        <div class="form-group" style="margin-left: 10%">
            <label>
                <input type="checkbox" class="flat-red"> test2
            </label>
            <label>
                <input type="checkbox" class="flat-red" disabled>
                test3
            </label>
        </div>
    </div>

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

