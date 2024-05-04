import type { Preview } from "@storybook/react";

const preview: Preview = {
  parameters: {
    controls: {
      matchers: {
        color: /(background|color)$/i,
        date: /Date$/i,
      },
    },
  },
};

export const parameters = {
  viewport: {
    viewport: {
      viewports: {
        iphonex: {
          name: "iPhone X",
          styles: {
            width: "375px",
            height: "812px",
          },
        },
      },
    },
    backgrounds: {
      values: [
        {
          name: "grey",
          value: "#808080",
        },
      ],
    },
  },
};

export default preview;
