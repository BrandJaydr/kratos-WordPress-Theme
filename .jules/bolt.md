## 2025-05-14 - [Inefficient Snow Animation and Timer]
**Learning:** The snow animation in `static/js/kratos.js` had multiple performance issues: repetitive DOM/attribute lookups in a high-frequency animation loop, expensive `Math.sqrt` calculations for every particle, and use of string-based `setInterval`. These led to unnecessary CPU usage and potential frame drops on lower-end devices.
**Action:** Hoist DOM lookups, use squared distance comparison for distance checks, pre-calculate constant strings, and use function references for timers.
