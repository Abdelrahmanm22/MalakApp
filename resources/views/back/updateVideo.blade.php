@include('back.includes.header')

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">AdminLTE 3</span> -->
        </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{URL::asset('back/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{$myUser->user_name}}</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item ">
                  <a href="{{route('allVoices')}}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Voices</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('allVideos')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Videos</p>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a href="{{route('allBooks')}}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Books</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('allSections')}}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sections</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('contact')}}" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Contact</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('rules')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Rules</p>
                  </a>
                </li>
              </ul>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Update Video</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('logout')}}">logout</a></li>
            <li class="breadcrumb-item active"><a href="{{route('adminHome')}}">Home</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
    <div class="card card-primary">
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                  {{Session::get('success')}}
                </div>
            @endif
              <div class="card-header">
                <h3 class="card-title">Update Video</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.update.video',$video->video_id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputTitle">Video Title</label>
                    <input type="text" class="form-control" value="{{$video->title}}"  name="title"  id="exampleInputTitle" placeholder="Enter Voice Title">
                    @error('title')
                       <small class="form-txt text-danger">{{$message}}</small>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputDescription">Video Description</label>
                    <textarea rows="4" cols="50" class="form-control" name="desc" id="exampleInputDescription" placeholder="Description">{{$video->description}}</textarea>
                    @error('desc')
                       <small class="form-txt text-danger">{{$message}}</small>
                    @enderror
                  </div>
                  <div class="alert alert-warning" role="alert">
                    Please Enter <a href="#" class="alert-link">URL of Video in YouTube </a> OR <a href="#" class="alert-link">Upload Video From PC</a>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputURL">URL Video</label>
                    <input type="text" class="form-control" value="{{$video->iframe}}"  name="iframe"  id="exampleInputURL" placeholder="Enter URL Video">
                    @error('iframe')
                       <small class="form-txt text-danger">{{$message}}</small>
                    @enderror
                  </div>
                  
                  
                  <div class="form-group">
                    <!-- <img src="" width="100px" height="100px"> -->
                    <label for="exampleInputVideo">Video File</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="video" value="{{$video->video}}" class="custom-file-input"  id="exampleInputVideo">
                        
                        <label class="custom-file-label" value for="exampleInputVideo">{{$video->video}}</label>
                        
                      </div>
                      
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                      
                    </div>
                    @error('video')
                        <small class="form-txt text-danger">{{$message}}</small>
                    @enderror
                  </div> 
                  
                  
                  <!-- <input type="hidden" class="form-control" name="id" id="exampleInputID" value="" > -->
                    
                </div>
                
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('back.includes.footer')