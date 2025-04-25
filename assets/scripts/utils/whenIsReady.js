function whenIsReady() {
  const wpData = window.wp?.data;

  if (!wpData?.select || !wpData?.subscribe) {
    return Promise.resolve(); // проще
  }

  const { select, subscribe } = wpData;

  return new Promise((resolve) => {
    const unsubscribe = subscribe(() => {
      const isNew = select('core/editor')?.isCleanNewPost?.();
      const hasBlocks = select('core/block-editor')?.getBlockCount?.() > 0;

      if (isNew || hasBlocks) {
        unsubscribe();
        resolve();
      }
    });
  });
}

export default whenIsReady;
