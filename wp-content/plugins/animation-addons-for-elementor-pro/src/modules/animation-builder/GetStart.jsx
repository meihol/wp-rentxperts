import {
  ResizableHandle,
  ResizablePanel,
  ResizablePanelGroup,
} from "@/components/ui/resizable";
import MainEditor from "@/components/editor/MainEditor";
import { cn } from "@/lib/utils";
import { useEffect, useState } from "react";
import { useAnimationControl, usePageConfig } from "./hooks/app.hooks";

const GetStart = () => {
  const { setPageConfig } = usePageConfig();
  const { setAllAnimation } = useAnimationControl();
  const [isLoading, setIsLoading] = useState(true);


  function disableIframeLinks() {
    const iframe = document.getElementById(
      "wcf--animation-builder--animation--preview"
    );
    iframe.onload = function () {
      const iframeDocument =
        iframe.contentDocument || iframe.contentWindow.document;

      const links = iframeDocument.querySelectorAll("a");

      links.forEach((link) => {
        link.addEventListener("click", function (event) {
          event.preventDefault();
        });
      });
    };
  }

  window.addEventListener(
    "message",
    (event) => {
      if (event?.data?.type === "wcf-animation-builder") {
        if (event?.data) {
          setAllAnimation(event.data?.animation_config || []);
          setPageConfig(event.data);
          setIsLoading(false);
        }
      }
    },
    false
  );

  useEffect(() => {
    disableIframeLinks();
  }, []);

  return (
    <ResizablePanelGroup direction="horizontal" className="max-w-full">
      <ResizablePanel
        defaultSize={85}
        className="min-w-[calc(100%-450px)] h-screen"
      >
        <iframe
          class="wcf--animation-builder-editor-iframe w-full h-full border-0"
          id="wcf--animation-builder--animation--preview"
          src={WCF_ADDONS_ANIMATION_BUILDER.iframe_url}
        ></iframe>
      </ResizablePanel>
      <ResizableHandle withHandle />
      <ResizablePanel
        defaultSize={15}
        className={cn("min-w-[280px] max-w-[450px]")}
      >
        <MainEditor isLoading={isLoading} />
      </ResizablePanel>
    </ResizablePanelGroup>
  );
};

export default GetStart;
