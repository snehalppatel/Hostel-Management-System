
@if(Auth::guard('admin')->check())
<li class="nav-item">
    <a href="{{ route('students.index') }}"
       class="nav-link {{ Request::is('students*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users menu-icon"></i>
        <p>Registration</p>
    </a>
</li>
@endif



<li class="nav-item">
    <a href="{{ route('admin.leaves.index') }}"
       class="nav-link {{ Request::is('leaves*') ? 'active' : '' }}">
       <i class="nav-icon fas fa-circle menu-icon"></i>       
        <p>Leave Request</p>
    </a>
</li>
<!-- <li class="nav-item">
    <a href="{{ route('admin.leaves.index') }}"
       class="nav-link {{ Request::is('leaves*') ? 'active' : '' }}">
       <i class="nav-icon fas fa-list menu-icon"></i>       
        <p>Outing Request</p>
    </a>
</li> -->
<li class="nav-item">
    <a href="{{ route('admin.outings.index') }}"
       class="nav-link {{ Request::is('outings*') ? 'active' : '' }}">
       <i class="nav-icon fas fa-list menu-icon"></i>              
        <p>Outings</p>
    </a>
</li>


{{--<li class="nav-item">
    <a href="{{ route('couriers.index') }}"
       class="nav-link {{ Request::is('couriers*') ? 'active' : '' }}">
       <i class="nav-icon fas fa-list menu-icon"></i>              
        <p>Orders</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('students.index',['type' => 'Warden']) }}"
       class="nav-link {{ Request::is('wardens*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users menu-icon"></i>       
        <p>Wardens</p>
    </a>
</li>--}}


