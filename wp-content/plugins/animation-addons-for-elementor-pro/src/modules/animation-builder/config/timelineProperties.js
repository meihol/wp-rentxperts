export const TProperties = [
  {
    name: "auto remove children",
    type: "boolean",
    default: "true",
    info: "Automatically removes completed child animations from a parent timeline to optimize memory",
  },
  {
    name: "delay",
    type: "number",
    unit: "s",
    info: "Delays the timeline start by the specified value (in seconds)",
  },
  {
    name: "repeat",
    type: "number",
    info: "Repeats the timeline a specified number of times, receiving a numeric value for the repeat count",
  },
  {
    name: "repeat delay",
    type: "number",
    unit: "s",
    info: "Sets a delay between each repeat of the timeline, receiving a numeric value (in seconds) for the delay duration",
  },
  {
    name: "yoyo",
    type: "boolean",
    default: "true",
    info: "Reverses the timeline’s playback direction after each repeat, receiving a boolean (true) or a numeric value for the yoyo effect.",
  },
];

export const AProperties = [
  {
    name: "x",
    type: "number",
    info: "Map input values to x-axis positions using linear mapping, e.g., input 50 (range 0-100) maps to x = 250px (range 0-500)",
  },
  {
    name: "y",
    type: "number",
    info: "Map input values to y-axis positions using linear mapping, e.g., input 50 (range 0-100) maps to y = 250px (range 0-500).",
  },
  {
    name: "opacity",
    type: "number",
    info: "Set opacity directly using received value (0 to 1)",
  },
  {
    name: "width",
    type: "string",
    info: "Width defines the horizontal size of an element",
  },
  {
    name: "height",
    type: "string",
    info: "Height defines the vertical size of an element",
  },
  {
    name: "scale",
    type: "number",
    info: "Scale resizes an element, e.g., 1.5 increases size by 1.5 times",
  },
  {
    name: "repeat",
    type: "number",
    info: "Repeat makes animations loop, e.g., 2 loops animation 2 times",
  },
  {
    name: "rotate",
    type: "string",
    info: "Rotate animates rotation, e.g., 180 rotates the element 180 degrees",
  },
  {
    name: "color",
    type: "color",
    info: "Color animates color changes, e.g., '#ff0000' changes text color to red",
  },
  {
    name: "background",
    type: "color",
    info: "Background animates background color, e.g., '#ff0000' changes background to red",
  },
  {
    name: "border",
    type: "string",
    info: "Border animates border properties, e.g., '2px solid #ff0000'",
  },
  {
    name: "box shadow",
    type: "string",
    info: "BoxShadow animates shadow effects, e.g., '0px 4px 10px rgba(0,0,0,0.5)' adds a shadow",
  },
  {
    name: "ease",
    type: "ease",
    default: "power2.out",
    info: "Ease controls animation speed, e.g., 'ease-in' starts animation slow and speeds up",
  },
  {
    name: "force3D",
    type: "boolean",
    default: "true",
    info: "Force3D forces 3D rendering, e.g., true improves performance by using hardware acceleration",
  },
  {
    name: "delay",
    type: "number",
    unit: "s",
    info: "Delay sets a pause before starting the animation, e.g., 2 waits 2 seconds before animating",
  },
  {
    name: "duration",
    type: "number",
    unit: "s",
    info: "Duration defines animation length, e.g., 2 makes the animation last 2 seconds",
  },
  {
    name: "max width",
    type: "string",
    info: "Max width animates the maximum width, e.g., '500px' increases max width to 500px",
  },
  {
    name: "max height",
    type: "string",
    info: "Max height animates the maximum height, e.g., '400px' increases max height to 400px",
  },
  {
    name: "min width",
    type: "string",
    info: "Min width animates the minimum width, e.g., '500px' increases max width to 500px",
  },
  {
    name: "min height",
    type: "string",
    info: "Min height animates the minimum height, e.g., '400px' increases max height to 400px",
  },
  {
    name: "mix blade mode",
    type: "string",
    info: "Mix blendMode controls blending of elements, e.g., 'multiply' blends the element with a darkening effect",
  },
  {
    name: "padding",
    type: "string",
    info: "Padding animates padding, e.g., '20px' increases padding to 20px",
  },
  {
    name: "radius",
    type: "string",
    info: "Radius animates corners, e.g., '50%' makes the element fully round",
  },
  {
    name: "repeat delay",
    type: "number",
    unit: "s",
    info: "Repeat delay sets delay between repeats, e.g., 1 adds 1 second pause between repetitions",
  },
  {
    name: "scaleX",
    type: "number",
    info: "ScaleX animates horizontal scaling, e.g., 2 doubles the width of the element",
  },
  {
    name: "scaleY",
    type: "number",
    info: "ScaleY animates vertical scaling, e.g., 1.5 increases the height by 1.5 times",
  },
  {
    name: "xPercent",
    type: "number",
    info: "XPercent moves an element horizontally as a percentage, e.g., 50 moves the element 50% of its width",
  },
  {
    name: "yPercent",
    type: "number",
    info: "YPercent moves an element vertically as a percentage, e.g., 50 moves the element 50% of its height",
  },
  {
    name: "yoyo",
    type: "boolean",
    default: "true",
    info: "Yoyo reverses the animation on each repeat, e.g., true makes the animation play forwards and then backwards",
  },
  {
    name: "custom",
    type: "custom",
    info: "Custom allows creating unique animations, e.g., x: 2, y: 2 creates a custom animation with specific properties",
  },
];

export const SProperties = [
  {
    name: "markers",
    type: "boolean",
    default: "false",
    info: "Markers shows start and end points of scroll animations, e.g., true displays visual markers for debugging",
  },
  {
    name: "anticipate pin",
    type: "number",
    info: "Anticipate Pin preps the pinned element for smoother transitions, e.g., 1 helps avoid layout shifts when pinning",
  },
  {
    name: "pin type",
    type: "pinType",
    default: "transform",
    info: "PinType defines the pinning method, e.g., 'transform' pins the element using CSS transform for smoother effects",
  },
  {
    name: "pinned container",
    type: "string",
    info: "Pinned container defines the container to be pinned, e.g., '.container' pins the entire container during scrolling",
  },
  {
    name: "custom",
    type: "custom",
    info: "Custom allows creating custom properties, e.g., x: 2, y: 2",
  },
];
