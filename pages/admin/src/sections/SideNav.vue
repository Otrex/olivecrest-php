<template>
	<div id='sidenav'>
		<nav >
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <router-link to='/users' class="nav-link" >
                  <span data-feather="file"></span> Users 
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to='/plans' class="nav-link" >
                  <span data-feather="file"></span> Plans
                </router-link>
              </li>
            </ul>
            
        
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Transaction Details</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <router-link to='/withdrawals' class="nav-link" >
                  <span data-feather="file"></span> Withdrawals
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to='/deposits' class="nav-link" >
                  <span data-feather="file"></span> Deposits
                </router-link>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>General Settings</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <router-link to='/gen-configuration' class="nav-link" >
                  <span data-feather="file"></span> General Configurations
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to='/trx-configuration' class="nav-link" >
                  <span data-feather="file"></span> Transaction Configurations
                </router-link>
              </li>
            </ul>
          </div>
        </nav>
	</div>
</template>
<script >
export default {
	name : 'SideNav',
	components : {}
};
</script>
<style type="text/css">
	
</style>