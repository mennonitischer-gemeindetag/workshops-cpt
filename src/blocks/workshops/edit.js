import ServerSideRender from "@wordpress/server-side-render";
import { InspectorControls } from "@wordpress/block-editor";
import {
  DateTimePicker,
  PanelBody,
  ToggleControl
} from "@wordpress/components";

export default props => {
  const {
    className,
    attributes: { date, isBefore },
    attributes,
    setAttributes
  } = props;
  return (
    <>
      <InspectorControls>
        <PanelBody>
          <DateTimePicker
            currentDate={date}
            onChange={date => setAttributes({ date })}
            is12Hour={false}
          />
          <ToggleControl
            label={"Comparison"}
            checked={isBefore}
            help={isBefore ? "Is before date." : "Is after date."}
            onChange={value => setAttributes({ isBefore: value })}
          />
        </PanelBody>
      </InspectorControls>
      <div className={className}>
        <ServerSideRender
          block="gemeindetag/workshops"
          attributes={attributes}
        />
      </div>
    </>
  );
};
