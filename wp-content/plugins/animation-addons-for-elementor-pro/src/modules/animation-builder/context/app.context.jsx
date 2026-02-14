import { createContext, useCallback, useReducer } from "react";
import { generateUniqueId } from "../../../utils/generateUniqueId";
import { copyTitle, removeFromDynamicCopy } from "@/lib/utils";
import { CheckProperties } from "@/lib/validationCheck";
import { toast } from "sonner";

const initialState = {
  contentStep: {
    step: 1,
    data: {},
  },
  allAnimation: [],
  pageConfig: {},
};

const reducer = (state, action) => {
  switch (action.type) {
    case "setContentStep":
      return { ...state, contentStep: action.value };
    case "setAllAnimation":
      return { ...state, allAnimation: action.value };
    case "setPageConfig":
      return { ...state, pageConfig: action.value };
    default:
      throw new Error();
  }
};

const useMainContext = (state) => {
  const [mainState, dispatch] = useReducer(reducer, state);

  const setContentStep = useCallback((data) => {
    dispatch({
      type: "setContentStep",
      value: data,
    });
  }, []);

  const setAllAnimation = useCallback((data) => {
    dispatch({
      type: "setAllAnimation",
      value: data,
    });
  }, []);

  const setPageConfig = useCallback((data) => {
    dispatch({
      type: "setPageConfig",
      value: data,
    });
  }, []);

  const createAnimation = useCallback(
    async (data) => {
      if (mainState.allAnimation.find((el) => el.id === data.id)) return;
      const result = [...mainState.allAnimation, data];

      setAllAnimation(result);

      await fetch(mainState.pageConfig.ajaxurl, {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          Accept: "application/json",
        },

        body: new URLSearchParams({
          action: "wcf_anim_builder_configs_store",
          pageTypeConfigs: JSON.stringify(mainState.pageConfig.pageTypeConfigs),
          wcf_nonce: mainState.pageConfig.nonce,
          animationConfigs: JSON.stringify(result),
        }),
      })
        .then((response) => {
          return response.json();
        })
        .then((return_content) => {
          toast("Animation Create Successfully");
        });
    },
    [mainState.allAnimation, mainState.pageConfig]
  );

  const updateAnimation = useCallback(async () => {
    await fetch(mainState.pageConfig.ajaxurl, {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
        Accept: "application/json",
      },
      body: new URLSearchParams({
        action: "wcf_anim_builder_configs_store",
        pageTypeConfigs: JSON.stringify(mainState.pageConfig.pageTypeConfigs),
        wcf_nonce: mainState.pageConfig.nonce,
        animationConfigs: JSON.stringify(mainState.allAnimation),
      }),
    })
      .then((response) => {
        return response.json();
      })
      .then((return_content) => {
        toast("Animation Save Successfully");
      });
  }, [mainState.allAnimation, mainState.pageConfig]);

  const temporarySave = useCallback(
    async (data) => {
      if (data?.scrollTrigger?.enable) {
        const isValid = CheckProperties(data?.scrollTrigger?.properties);

        if (isValid.status) {
          const result = mainState.allAnimation.map((el) => {
            if (el.id === data.id) {
              return data;
            } else {
              return el;
            }
          });
          setAllAnimation(result);
        } else {
          updateContentData(
            { ...data?.scrollTrigger, properties: isValid.data },
            "scrollTrigger"
          );
        }
      } else {
        const result = mainState.allAnimation.map((el) => {
          if (el.id === data.id) {
            return data;
          } else {
            return el;
          }
        });
        setAllAnimation(result);
      }
    },
    [mainState.allAnimation, mainState.contentStep]
  );

  const duplicateAnimation = useCallback(
    (id) => {
      const data = mainState?.allAnimation?.find((el) => el.id === id);
      const sameTitle = mainState?.allAnimation?.filter((el) => {
        if (el.title === data.title) {
          return el;
        } else if (removeFromDynamicCopy(el.title) === data.title) {
          return el;
        }
      });

      const modifyTitle = copyTitle(data.title, sameTitle);
      const result = [
        ...mainState.allAnimation,
        { ...data, id: generateUniqueId(), title: modifyTitle },
      ];
      setAllAnimation(result);
    },
    [mainState.allAnimation]
  );

  const deleteAnimation = useCallback(
    async (id) => {
      const result = mainState?.allAnimation?.filter((el) => el.id !== id);
      setAllAnimation(result);

      await fetch(mainState.pageConfig.ajaxurl, {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          Accept: "application/json",
        },
        body: new URLSearchParams({
          action: "wcf_anim_builder_configs_store",
          pageTypeConfigs: JSON.stringify(mainState.pageConfig.pageTypeConfigs),
          wcf_nonce: mainState.pageConfig.nonce,
          animationConfigs: JSON.stringify(result),
        }),
      })
        .then((response) => {
          return response.json();
        })
        .then((return_content) => {
          toast("Animation Delete Successfully");
        });
    },
    [mainState.allAnimation, mainState.pageConfig]
  );

  const updateContentData = useCallback(
    (data, key) => {
      let result;
      if (key) {
        result = {
          ...mainState.contentStep,
          data: { ...mainState.contentStep?.data, [key]: data },
        };
      } else {
        result = data;
      }
      setContentStep(result);
      temporarySave(result.data);
    },
    [mainState.contentStep]
  );

  const updateTimelineData = useCallback(
    (data) => {
      if (data) {
        const items = mainState?.contentStep?.data?.timelines?.map((el) => {
          if (el.id === data.id) {
            el = data;
            return el;
          } else {
            return el;
          }
        });
        if (items) {
          const result = {
            ...mainState.contentStep,
            data: {
              ...mainState.contentStep?.data,
              timelines: items,
            },
          };
          setContentStep(result);
          temporarySave(result.data);
        }
      }
    },
    [mainState.contentStep]
  );

  const updateAnimationData = useCallback(
    (data) => {
      if (data) {
        const items = mainState?.contentStep?.data?.animations?.map((el) => {
          if (el.id === data.id) {
            el = data;
            return el;
          } else {
            return el;
          }
        });
        if (items) {
          const result = {
            ...mainState.contentStep,
            data: {
              ...mainState.contentStep?.data,
              animations: items,
            },
          };
          setContentStep(result);
          temporarySave(result.data);
        }
      }
    },
    [mainState.contentStep]
  );

  const duplicateTimeline = useCallback(
    (id) => {
      const fullContent = { ...mainState.contentStep };
      const { timelines } = fullContent?.data;
      const data = timelines?.find((el) => el.id === id);
      const sameTitle = timelines?.filter((el) => {
        if (el.title === data.title) {
          return el;
        } else if (removeFromDynamicCopy(el.title) === data.title) {
          return el;
        }
      });

      const modifyTitle = copyTitle(data.title, sameTitle);

      fullContent.data.timelines = [
        ...fullContent.data.timelines,
        { ...data, id: generateUniqueId(), title: modifyTitle },
      ];
      setContentStep(fullContent);
      temporarySave(fullContent.data);
    },
    [mainState.contentStep]
  );

  const deleteTimeline = useCallback(
    (id) => {
      const fullContent = { ...mainState.contentStep };
      const { timelines } = fullContent?.data;
      const result = timelines?.filter((el) => el.id !== id);

      fullContent.data.timelines = result;
      setContentStep(fullContent);
      temporarySave(fullContent.data);
    },
    [mainState.contentStep]
  );

  const duplicateAnimationData = useCallback(
    (id) => {
      const fullContent = { ...mainState.contentStep };
      const { animations } = fullContent?.data;
      const data = animations?.find((el) => el.id === id);
      const sameTitle = animations?.filter((el) => {
        if (el.title === data.title) {
          return el;
        } else if (removeFromDynamicCopy(el.title) === data.title) {
          return el;
        }
      });

      const modifyTitle = copyTitle(data.title, sameTitle);

      fullContent.data.animations = [
        ...fullContent.data.animations,
        { ...data, id: generateUniqueId(), title: modifyTitle },
      ];
      setContentStep(fullContent);
      temporarySave(fullContent.data);
    },
    [mainState.contentStep]
  );

  const deleteAnimationData = useCallback(
    (id) => {
      const fullContent = { ...mainState.contentStep };
      const { animations } = fullContent?.data;
      const result = animations?.filter((el) => el.id !== id);

      fullContent.data.animations = result;
      setContentStep(fullContent);
      temporarySave(fullContent.data);
    },
    [mainState.contentStep]
  );

  return {
    mainState,
    setContentStep,
    setAllAnimation,
    updateContentData,
    updateTimelineData,
    updateAnimationData,
    createAnimation,
    updateAnimation,
    temporarySave,
    duplicateAnimation,
    deleteAnimation,
    duplicateTimeline,
    deleteTimeline,
    duplicateAnimationData,
    deleteAnimationData,
    setPageConfig,
  };
};

export const AppContext = createContext({
  mainState: initialState,
  setContentStep: () => {},
  setAllAnimation: () => {},
  setPageConfig: () => {},
});

export const AppContextProvider = ({ children }) => {
  return (
    <AppContext.Provider value={useMainContext(initialState)}>
      {children}
    </AppContext.Provider>
  );
};
