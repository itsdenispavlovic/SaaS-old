<li class="nav-item {{ Request::is('admin/users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.users.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Users</span>
    </a>
</li>
<li class="nav-item {{ Request::is('admin/plans*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.plans.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Plans</span>
    </a>
</li>
<li class="nav-item {{ Request::is('admin/nodes*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.nodes.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Nodes</span>
    </a>
</li>
