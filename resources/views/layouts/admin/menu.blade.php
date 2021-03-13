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
<li class="nav-item {{ Request::is('admin/newsletters*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.newsletters.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Newsletters</span>
    </a>
</li>

<h6>Contact settings</h6>

<li class="nav-item {{ Request::is('admin/contacts*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.contacts.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Contacts</span>
    </a>
</li>
<li class="nav-item {{ Request::is('admin/contactTypes*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.contactTypes.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Contact Types</span>
    </a>
</li>
