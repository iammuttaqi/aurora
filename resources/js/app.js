import "./bootstrap";

import collapse from "@alpinejs/collapse";
import focus from "@alpinejs/focus";
import persist from "@alpinejs/persist";
import Alpine from "alpinejs";

window.Alpine = Alpine;
Alpine.plugin(collapse);
Alpine.plugin(persist);
Alpine.plugin(focus);

Alpine.start();
