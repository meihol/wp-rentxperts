import { AppContext } from "@/context/app.context";
import { useContext } from "react";

export const useContentStep = () => {
  const {
    mainState: { contentStep },
    setContentStep,
    updateContentData,
    updateTimelineData,
    updateAnimationData,
    duplicateTimeline,
    deleteTimeline,
    duplicateAnimationData,
    deleteAnimationData,
  } = useContext(AppContext);
  return {
    contentStep,
    setContentStep,
    updateContentData,
    updateTimelineData,
    updateAnimationData,
    duplicateTimeline,
    deleteTimeline,
    duplicateAnimationData,
    deleteAnimationData,
  };
};

export const useAnimationControl = () => {
  const {
    mainState: { allAnimation },
    createAnimation,
    updateAnimation,
    temporarySave,
    duplicateAnimation,
    deleteAnimation,
    setAllAnimation,
  } = useContext(AppContext);
  return {
    allAnimation,
    createAnimation,
    updateAnimation,
    temporarySave,
    duplicateAnimation,
    deleteAnimation,
    setAllAnimation,
  };
};

export const usePageConfig = () => {
  const {
    mainState: { pageConfig },
    setPageConfig,
  } = useContext(AppContext);
  return {
    pageConfig,
    setPageConfig,
  };
};
