# Kratos {English Version} - Jaydr Fork

This fork maintains an English version of the Kratos theme with performance optimizations and modern WordPress compatibility.

## Commit History

| Date | Description |
| :--- | :--- |
| 2025-05-14 | ⚡ Bolt: Optimized snow animation and site timer performance. Hoisted DOM lookups and replaced expensive math. |
| 2025-05-14 | 🌐 Translation: Completed full translation of frontend UI, theme options, and Live2D messages to English. |

## Error & Vulnerability Log

| ID | Date | Type | Description | Resolution |
| :--- | :--- | :--- | :--- | :--- |
| ERR-001 | 2025-05-14 | Logic | Inefficient DOM lookups in 60fps loop. | Hoisted lookups to parent scope. |
| ERR-002 | 2025-05-14 | Perf | Expensive Math.sqrt in interaction logic. | Used squared distance comparison. |
| ERR-003 | 2025-05-14 | UX | Mandarin strings in English version. | Translated strings in PHP, JS, and JSON files. |
