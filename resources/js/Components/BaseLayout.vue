<template>
    <div class="min-h-screen flex flex-col">
      <header class="nav-down responsive-nav hidden-lg hidden-md">
            <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            <div id="main-nav" class="collapse navbar-collapse">
                <nav>
                    <ul class="nav navbar-nav">
                        <li><a href="/">Home</a></li>
                        <li><a href="/videos">Video</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="sidebar-navigation hidde-sm hidden-xs">
            <div class="logo">
                <a href="#">Stream<em> Naija</em></a>
            </div>
            <nav>
                <ul>
                    <li>
                        <a href="/">
                            <span class="rect"></span>
                            <span class="circle"></span>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="/videos">
                            <span class="rect"></span>
                            <span class="circle"></span>
                            Video
                        </a>
                    </li>
                    
                </ul>
            </nav>
        </div>
      <main class="flex-1 p-6">
        <slot />
      </main>
    </div>
  </template>
  