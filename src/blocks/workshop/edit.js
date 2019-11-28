import {
  TimePicker,
  TextControl,
  TextareaControl,
  CheckboxControl,
  RangeControl
} from "@wordpress/components";
import { Fragment } from "@wordpress/element";

export default props => {
  const {
    attributes: {
      leiter,
      character,
      beschreibung,
      beschraenkt,
      maxPlaetze,
      nr,
      endZeit,
      startZeit,
      preis
    },
    className,
    setAttributes
  } = props;

  return (
    <Fragment>
      <div className={className}>
        <RangeControl
          label="Workshop Nummer"
          value={nr}
          onChange={nr => setAttributes({ nr })}
          min={1}
          max={100}
        />
        <TextControl
          label={"Character"}
          value={character}
          onChange={character => setAttributes({ character })}
        />
        <TextControl
          label={"Leiter"}
          value={leiter}
          onChange={leiter => setAttributes({ leiter })}
        />
        <TextareaControl
          label={"Beschreibung"}
          value={beschreibung}
          onChange={beschreibung => setAttributes({ beschreibung })}
        />
        <TextControl
          label={"Preis"}
          value={preis}
          onChange={preis => setAttributes({ preis })}
        />
        <CheckboxControl
          heading={"Beschränkte Anzahl an Teilnehmern"}
          checked={beschraenkt}
          onChange={beschraenkt => setAttributes({ beschraenkt })}
        />
        {beschraenkt && (
          <RangeControl
            label="Maximale Plätze"
            value={maxPlaetze}
            onChange={maxPlaetze => setAttributes({ maxPlaetze })}
            min={1}
            max={100}
          />
        )}
        <div className={`gemiendetage-tiles`}>
          <span className={`gemeindetage-time-picker`}>
            <label htmlFor="startZeitPicker">Start Zeit</label>
            <TimePicker
              id="startZeitPicker"
              currentTime={startZeit}
              onChange={newDate => setAttributes({ startZeit: newDate })}
              is12Hour={false}
            />
          </span>
          <span className={`gemeindetage-time-picker`}>
            <label htmlFor="endZeitPicker">End Zeit</label>
            <TimePicker
              id="endZeitPicker"
              currentTime={endZeit}
              onChange={newDate => setAttributes({ endZeit: newDate })}
              is12Hour={false}
            />
          </span>
        </div>
      </div>
    </Fragment>
  );
};
