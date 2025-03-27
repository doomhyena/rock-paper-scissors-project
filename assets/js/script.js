"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
var _a;
Object.defineProperty(exports, "__esModule", { value: true });
const jquery_1 = __importDefault(require("jquery"));
(0, jquery_1.default)("#users").load("finduser.php?keresett=");
(_a = document.getElementById("search-box")) === null || _a === void 0 ? void 0 : _a.addEventListener('keyup', (e) => {
    const ertek = e.target.value;
    (0, jquery_1.default)("#users").load("finduser.php?keresett=" + ertek);
});
