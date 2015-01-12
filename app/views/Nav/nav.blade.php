<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>easyProcess</title>

  @include('admin._partials.assets')


<link rel="stylesheet" href="{{ URL::asset('css/screen.css') }}">
</head>
<body>

   {{Notification::showAll()}}
   <section class="dark">
		<div class="container">
			
			<div class="row text-center">
				<div class="col-sm-6">
					<span class="circle circle-lg circle-blue">
						<i class="fa fa-exchange fa-rotate-90"></i>
					</span>

					<h4><a href="{{ URL::route('payment.start') }}">付款申请</a>

					
					</h4>
					<p>
						Nothing to download or install. Surreal does
						everything over FTP, SFTP, or Amazon&nbsp;S3.
					</p>
				</div>
				<div class="col-sm-6">
					<span class="circle circle-lg circle-green">
						<i class="fa fa-file-text-o"></i>
					</span>
					<h4>个人报销</h4>
					<p>
						Select which parts of the page clients can edit.
						Integrate without touching any code!
					</p>
				</div>
				</div>
				<div class="row text-center">
				<div class="col-sm-6">
					<span class="circle circle-lg circle-orange">
						<i class="fa fa-pencil"></i>
						
					</span>
					<h4><h4><a href="{{ URL::route('vendor.create') }}">供应商申请</a></h4>
					<p>
						Editing is as simple as typing on the page.
						Your design is left intact and all changes are
						tracked.
					</p>
				</div>
				
				<div class="col-sm-6">
					<span class="circle circle-lg circle-orange">
						<i class="fa fa-pencil"></i>
					</span>
					<h4>申请列表</h4>
					<p>
						Editing is as simple as typing on the page.
						Your design is left intact and all changes are
						tracked.
					</p>
				</div>
				
			</div>

		</div>
	</section>

   
   
   
   
   
   
   <hr>
	<div class="footer">
        <p>&copy; easyProcess.cn 2014</p>
    </div>
</div>
</body>
</html>