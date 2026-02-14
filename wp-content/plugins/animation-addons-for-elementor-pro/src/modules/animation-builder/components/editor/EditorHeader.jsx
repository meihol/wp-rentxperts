import { IconCross } from "@/lib/icons";
import {
  Dialog,
  DialogClose,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/components/ui/dialog";
import { Button, buttonVariants } from "@/components/ui/button";
import { cn } from "@/lib/utils";
import { useAnimationControl, useContentStep } from "@/hooks/app.hooks";

const EditorHeader = () => {
  const { contentStep } = useContentStep();
  const { updateAnimation } = useAnimationControl();

  const previewUrl = new URL(WCF_ADDONS_ANIMATION_BUILDER.iframe_url);
  previewUrl.searchParams.delete("action");

  return (
    <div className="flex justify-between items-center gap-2 p-3 border-b border-border">
      <h2 className="text-[13px]">Custom Animation</h2>

      <Dialog>
        <DialogTrigger asChild>
          <Button className="h-4 w-4 bg-transparent hover:bg-transparent [&_svg]:size-3">
            <IconCross />
          </Button>
        </DialogTrigger>
        <DialogContent className="sm:max-w-[400px]">
          <DialogHeader className={"hidden"}>
            <DialogTitle></DialogTitle>
            <DialogDescription></DialogDescription>
          </DialogHeader>
          <div>
            <h2>Do you want to close this</h2>
          </div>
          <DialogFooter>
            <a
              href={previewUrl}
              className={cn(
                buttonVariants({ variant: "secondary" }),
                "no-underline"
              )}
              onClick={() => {
                if (contentStep?.data?.id) {
                  updateAnimation(contentStep.data);
                }
              }}
            >
              Save & Close
            </a>

            <DialogClose asChild>
              <a
                href={previewUrl}
                className={cn(buttonVariants(), "no-underline")}
              >
                Discard Change
              </a>
            </DialogClose>
          </DialogFooter>
        </DialogContent>
      </Dialog>
    </div>
  );
};

export default EditorHeader;
