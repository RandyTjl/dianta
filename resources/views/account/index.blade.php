@extends('layouts.body')

@section('title',"账号信息")
@section('name',"url")

@section('content')
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">个人账号</h3>
      </div>
      <input type="text" style="display: none" id="user_id"  value="{{$user->id}}">
      <form role="form">
        <div class="card-body">
          <div class="form-group">
            <label for="email">邮箱</label>
            <input type="email"  name="email" class="form-control" id="email" placeholder="邮箱地址" value="{{$user->email}}">
          </div>
          <div class="form-group">
            <label for="password">密码</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="密码" value="{{$user->password}}">
          </div>
          <div class="form-group">
            <label for="name">昵称</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="昵称" value="{{$user->name}}">
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
            <div style="border: 1px chocolate solid;margin-top: 2px;padding: 2px;">
              <img src="{{empty($user->image)?'dist/img/user2-160x160.jpg':$user->image}}" width="80px" height="80px">
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="button" class="btn btn-primary" id="save">保存</button>
        </div>
      </form>
    </div>
@endsection

@section('script')
  <script>
      $().ready(function () {
          $("#save").on('click',function () {
              var data = $("form").serialize();
              var url = '/account/'+$("#user_id").val();
              $.ajax({
                  type:'PUT',
                  data:data,
                  url:url,
                  beforeSend:function () {
                    load_html(1);
                  },
                  success:function (msg) {
                      if(msg.code == 200){
                          window.location.reload();
                      }else{
                          alert(msg.message);
                      }
                  },
                  error:function (err) {
                      close_load_html();
                      alert("网络连接错误");
                  }

              })
          })
      })
  </script>
@endsection

