import { IconPlus2 } from "@/lib/icons";
import { Button } from "../ui/button";
import EditorBody from "./EditorBody";
import EditorFooter from "./EditorFooter";
import EditorHeader from "./EditorHeader";
import { useAnimationControl, useContentStep } from "@/hooks/app.hooks";
import { ABPresetData } from "@/config/animationPresetData";
import { generateUniqueId } from "../../../../utils/generateUniqueId";
import { Skeleton } from "../ui/skeleton";

const MainEditor = ({ isLoading }) => {
  const { contentStep, setContentStep } = useContentStep();
  const { createAnimation, allAnimation } = useAnimationControl();
  return (
    <div className="bg-background h-full flex flex-col justify-between relative">
      <EditorHeader />
      {contentStep.step === 1 && (
        <div className="p-3 border-b border-border">
          <Button
            variant="play"
            size="play"
            onClick={() => {
              const sampleData = {
                ...ABPresetData,
                id: generateUniqueId(),
                title:
                  ABPresetData.title +
                  (allAnimation.length ? "_" + (allAnimation.length + 1) : ""),
              };
              setContentStep({
                step: 2,
                data: sampleData,
              });
              createAnimation(sampleData);
            }}
          >
            <IconPlus2 /> Add new animation
          </Button>
        </div>
      )}

      <div className="flex-1">
        {isLoading ? (
          <div className="space-y-2 p-4">
            <Skeleton className="h-4 w-[250px]" />
            <Skeleton className="h-4 w-[200px]" />
          </div>
        ) : (
          <EditorBody contentStep={contentStep} />
        )}
      </div>
      <EditorFooter />
    </div>
  );
};

export default MainEditor;
