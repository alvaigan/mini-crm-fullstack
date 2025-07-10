import DashboardLayout from "../layouts/DashboardLayout.vue";
import DashboardView from "../pages/DashboardView.vue";
import ContactsView from "../pages/ContactsView.vue";
import CallLogsView from "../pages/CallLogsView.vue";

const routes = [
    {
        path: "/",
        component: DashboardLayout,
        children: [
            { path: "/", component: DashboardView },
            { path: "/contacts", component: ContactsView },
            { path: "/call-logs", component: CallLogsView },
        ],
    },
];

export default routes;
