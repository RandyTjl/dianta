/**
 * Created by PhpStorm.
 * User: Randy
 * Date: 2018/7/9
 * Time: 9:39
 */
@section('title',"账号信息");
@section('name',"url");

@extends('layouts.body')

@section('content')
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">个人账号</h3>
      </div>
      <form role="form">
        <div class="card-body">
          <div class="form-group">
            <label for="Email">邮箱</label>
            <input type="email"  name="email" class="form-control" id="exampleInputEmail1" placeholder="邮箱地址">
          </div>
          <div class="form-group">
            <label for="Password">密码</label>
            <input type="password" name="password" class="form-control" id="Password" placeholder="密码">
          </div>
          <div class="form-group">
            <label for="name"></label>
            <input type="text" name="name" class="form-control" id="name" placeholder="昵称">
          </div>
          <div class="form-group">
            <label for="image" >头像</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file"  name="image" class="custom-file-input" id="image">
                <label class="custom-file-label" for="image">Choose file</label>
              </div>
              <div class="input-group-append">
                <span class="input-group-text" id="upload">Upload</span>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="button" class="btn btn-primary">保存</button>
        </div>
      </form>
    </div>

@endsection

