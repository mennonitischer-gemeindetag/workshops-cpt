import { registerBlockType } from "@wordpress/blocks";

import metadata from "./block.json";
import edit from "./edit";
import save from "./save";

import "./index.css";

registerBlockType(metadata, {
  edit,
  save
});
