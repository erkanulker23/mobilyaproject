import StickySidebar from "sticky-sidebar";

if (document.getElementById('sticky-sidebar') !== null) {
    let sidebar = new StickySidebar('#sticky-sidebar', {
        containerSelector: '#sticky-sidebar-container',
        innerWrapperSelector: '.sidebar__inner',
        topSpacing: 20,
        bottomSpacing: 20,
        minWidth: 990,
    });

    var stickySidebarContainer = document.getElementById('sticky-sidebar-container');

    var observer = new window.ResizeObserver(entries => {
        sidebar.updateSticky();
    });

    observer.observe(stickySidebarContainer);
}
