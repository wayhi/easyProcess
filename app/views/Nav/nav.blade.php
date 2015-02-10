@extends('admin._layouts.default')
 
@section('main')


   <section class="light">
		<div class="container">
			
			<div class="row text-center ">
				<div class="span4">
					<span class="circle circle-lg circle-green">
						<i class="fa fa-edit"></i>
					</span>

					<h4><a href="{{ URL::route('payment.start') }}">付款申请</a>

					
					</h4>
					<p>
						
					</p>
				</div>
				<div class="span4">
					<span class="circle circle-lg circle-green">
						<i class="fa fa-file-text-o"></i>
					</span>
					<h4>个人报销</h4>
					<p>
						
					</p>
				</div>
				
				<div class="span4">
					<span class="circle circle-lg circle-orange">
						<i class="fa fa-list"></i>
					</span>
					<h4><a href="{{URL::route('payment.index')}}">申请列表</a></h4>
					<p>
						
					</p>
				</div>
				
				</div>
			<div class="row text-center">
				<div class="span4">
					<span class="circle circle-lg circle-orange">
						<i class="fa fa-check"></i>
						
					</span>
					<h4><a href="{{ URL::route('approval.index') }}">等待审批</a>
					
					
					<span class="badge badge-important">{{$count or ''}}</span>
					 
					
					</h4>
					<p>
						
					</p>
				</div>
				
				<div class="span4">
					<span class="circle circle-lg ">
						<i class="fa fa-user"></i>
					</span>
					<h4><a href="{{URL::route('register')}}">用户设置</a></h4>
					<p>
						
					</p>
				</div>
				
				<div class="span4">
					<span class="circle circle-lg">
						<i class="fa fa-wrench"></i>
					</span>
					<h4><a href="{{URL::route('admin.approval.create')}}">系统管理</a></h4>
					<p>
						
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

@stop