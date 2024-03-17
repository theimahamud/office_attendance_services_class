<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ count($department) }}</h3>
                <h4>Departments</h4>
            </div>
            <div class="icon">
                <i class="ion ion-ios-briefcase"></i>
            </div>
            <a href="{{ route('departments.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ count($designation) }}</h3>
                <h4>Designations</h4>
            </div>
            <div class="icon">
                <i class="ion ion-briefcase"></i>
            </div>
            <a href="{{ route('designations.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ count($user) }}</h3>
                <h4>Users</h4>
            </div>
            <div class="icon">
                <i class="ion ion-ios-people"></i>
            </div>
            <a href="{{ route('users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
