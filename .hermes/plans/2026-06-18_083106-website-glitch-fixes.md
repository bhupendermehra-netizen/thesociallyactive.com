# Website Glitch Fixes — Remaining Issues Plan

> **For Hermes:** Use direct tool calls or subagent-driven-development to implement task-by-task.

**Goal:** Fix all remaining UI/UX glitches, duplicate code, and orphan files in the Laravel placement website after matching Hostinger's 2 differences.

**Architecture:** Monolithic CSS (4004 lines) + Blade template (1212 lines) + jQuery JS. Fixes are surgical — inline CSS in blade, external CSS edits, HTML fixes. No new files needed.

**Tech Stack:** Laravel 12, PHP 8.2, CSS3, jQuery, GSAP, SQLite

**Current State:** 2 of ~15 glitches fixed (`.invisible_page` CSS, GSAP heading structure). 3 video tags with missing `>`. 9 duplicate `id="video_banner_section"`. 3 duplicate `@media (max-width:800px)`. 5 duplicate `@media (max-width:1000px)`. 2 dead code blocks. 4 orphan files. 1 copy-paste bug on section 4 top value.

---

## Task 1: Fix missing `>` on broken `<video>` tags

**Objective:** Close 3 `<video>` tags missing closing `>` — prevents HTML parsing errors

**Files:**
- Modify: `resources/views/index.blade.php:64,586,1019`

**Step 1: Fix L64 — video with data-played-once**

Line: `<video playsinline muted class="video_customize2 lazy-load" data-cursor="2" data-played-once="0"`

Check if `>` is on the next line first — if yes, the tag is fine and skip. If `>` is missing entirely, add `>` at the end.

Run: `sed -n '64,70p' resources/views/index.blade.php`

**Step 2: Fix L586 — section 1 video**

Change:
```
<video playsinline="" id="video_banner_section" class="mobile-view2 video_customize2 lazy-load" data-cursor="2" autoplay muted loop
```
To:
```
<video playsinline="" id="video_banner_section" class="mobile-view2 video_customize2 lazy-load" data-cursor="2" autoplay muted loop>
```

**Step 3: Fix L1019 — our-story video**

Change:
```
<video class="lazy-load" playsinline muted loop autoplay
```
To:
```
<video class="lazy-load" playsinline muted loop autoplay>
```

**Verification:** `grep -n '<video' index.blade.php | grep -v '>$'` — should return 0 results

---

## Task 2: Fix duplicate `id="video_banner_section"`

**Objective:** Replace duplicate IDs with unique `id="video_banner_section_N"` (N=1-9) or remove `id` attribute entirely (HTML validator requirement — duplicate IDs invalid)

**Files:**
- Modify: `resources/views/index.blade.php` (9 occurrences across sections 1-4)

**Approach:** Since these are section-specific video IDs and JS references `#video_banner_section`, keep the first occurrence's ID intact, change the rest to `class="video_banner_video"` (no `id`), and update any JS that references `#video_banner_section` to use class-based selector.

**Step 1: Check if JS references `#video_banner_section`**

Run: `grep -n 'video_banner_section' public/assets/js/script.js`

**Step 2: Replace duplicate IDs**

Sections 2/3/4 videos: change `id="video_banner_section"` to `class="video_banner_section"` (remove duplicate id).

**Verification:** `grep -c 'id="video_banner_section"' index.blade.php` should be 1

---

## Task 3: Fix copy-paste bug — Section 4 top value

**Objective:** Section 4 has `top: 31%` (same as section 1). Following the pattern (31%, 46%, 61%), section 4 should be `top: 76%`.

**Files:**
- Modify: `resources/views/index.blade.php:701`

**Step 1:** Change `top: 31%;` to `top: 76%;` on L701 (section 4).

**Verification:** All 4 sections should follow this pattern:
- Section 1: top 31%
- Section 2: top 46%
- Section 3: top 61%
- Section 4: top 76%

---

## Task 4: Remove orphan/duplicate files

**Objective:** Clean up 4 orphaned files the user marked for deletion

**Files to delete (user will handle this themselves):**
- `public/assets/css/style - Copy.css` (55KB — duplicate of style.css)
- `public/assets/js/script - Copy.js` (61KB — duplicate of script.js)
- `public/assets/js/background_script.js` (35KB — unused)
- `public/assets/js/shader.js` (2KB — unused)

**Warning for user:** Verify these files aren't referenced anywhere before deleting:
Run: `grep -r 'style - Copy\|script - Copy\|background_script\|shader\.js' resources/ views/ public/assets/css/ public/assets/js/ --include="*.php" --include="*.js" --include="*.css"`

---

## Task 5: Remove dead/superfluous `@media` blocks

**Objective:** Consolidate 3x `@media (max-width: 800px)` and 5x `@media (max-width: 1000px)` blocks — each is duplicated 2-3 times with identical rules

**Files:**
- Modify: `public/assets/css/style.css`

**Step 1:** Identify exact duplicate blocks (same CSS rules repeated at different lines)

Run: `grep -n '@media screen and (max-width: 800px)' style.css` — 3 occurrences
Run: `grep -n '@media screen and (max-width:1000px)' style.css` — 5 occurrences

**Step 2:** For each media query group:
- Keep only ONE copy of each unique rule
- Remove exact duplicates (keep the most complete set)
- Merge any unique rules from extra copies

**Step 3:** After consolidation, verify:
Run: `grep -c '@media screen and (max-width: 800px)' style.css` — should be 1
Run: `grep -c '@media screen and (max-width:1000px)' style.css` — should be 1 (or 2 if unique CSS in both banner + MOBILE SCROLL FIX)

**Risks:** Multiple identical `@media` blocks means last one wins in CSS — already the case, so consolidation is safe.

---

## Task 6: Remove dead code blocks in index.blade.php

**Objective:** Remove 2 commented-out blocks no longer needed

**Files:**
- Modify: `resources/views/index.blade.php`

**Step 1:** Remove commented-out contact form popup fallback (L19-49):
```
{{-- <div class="video_banner_section" style="background:white"> ...
```
And the commented-out heading variants:
```
{{--{{(isset($pages['home_banner'][0]) ? $pages['home_banner'][0]->text : '')}}<br> <span ...
```

**Step 2:** Remove the commented-out expertise_section block (L288-335):
```
{{-- <div class="expertise_section page-section" data-change="0"> --}}
...
{{-- </div> --}}
```

**Step 3:** Remove the commented-out second `invisible_page` (L643):
```
{{-- <div class="invisible_page desktop-view page-section"> --}}
```

**Verification:** `grep -c '{{--' index.blade.php` — should show fewer.

---

## Task 7: Fix `body overflow-y: hidden` blocking scroll

**Objective:** Change `overflow-y: hidden` to `overflow-y: auto` so the page scrolls properly. The MOBILE SCROLL FIX already overrides this for mobile; desktop also needs it.

**Files:**
- Modify: `public/assets/css/style.css:87`

**Step 1:** Change:
```css
body {
	font-family: 'Montserrat';
	overflow-x: hidden;
	overflow-y: hidden;
}
```
To:
```css
body {
	font-family: 'Montserrat';
	overflow-x: hidden;
	overflow-y: auto;
}
```

**Risks:** The preloader JS already sets `overflow-y: visible` after load, but the initial `hidden` state can cause layout issues. Testing needed.

**Verification:** After fix, page should scroll on desktop without JS override. Check if JS `$("body").css("overflow-y", "visible")` in preloader still works.

---

## Task 8: Fix `.page-section opacity: 0` hiding sections

**Objective:** Change base opacity from 0 to 1 — sections invisible until scrollF() runs

**Files:**
- Modify: `public/assets/css/style.css:63`

**Step 1:** Check if `scrollF()` function actually sets opacity. If sections only appear when scrolled (animation), keep `opacity: 0` but add `opacity: 1 !important` on inner containers OR set `opacity: 1` at line 63 and let scrollF() handle it via inline style.

**Recommendation:** Change to `opacity: 1` at line 63 since the `data-id="N"` sections already have inline `opacity: 1` and MOBILE SCROLL FIX overrides it anyway.

---

## Risks & Open Questions

1. **Duplicate `id` removal:** If JS explicitly targets `#video_banner_section` via jQuery, removing IDs will break mute/unmute toggles. Must verify JS references first.

2. **CSS cascade:** Multiple duplicate `@media` blocks mean the last declaration wins — already the case. Consolidation merely reduces file size.

3. **User handles deletions:** Task 4 files (orphans) the user said "delete dupicate ya bada ma kera ga" — they'll handle these themselves.

4. **Hostinger sync:** After all fixes, compare total line counts with Hostinger version the user shared to confirm parity.

5. **No git:** Project has no git repo (confirmed earlier). All changes are manual file edits. User should `cp -r` backup before starting.

---

## Summary Table

| # | Issue | Severity | File | Lines | ETA |
|---|-------|----------|------|-------|-----|
| 1 | Missing `>` on video tags | Critical | index.blade.php | 64,586,1019 | 2 min |
| 2 | Duplicate video IDs (8 extra) | High | index.blade.php | ~10 lines | 3 min |
| 3 | Section 4 top: 31% (should be 76%) | Medium | index.blade.php | 701 | 1 min |
| 4 | Orphan files (4 files) | Low | public/assets/ | — | User does |
| 5 | Duplicate @media blocks | Low | style.css | ~30 lines | 5 min |
| 6 | Dead code blocks | Low | index.blade.php | ~50 lines | 3 min |
| 7 | body overflow-y: hidden | Critical | style.css | 87 | 1 min |
| 8 | page-section opacity: 0 | Medium | style.css | 63 | 1 min |

Total implementation time: ~15 minutes (user's orphan deletion excluded).
