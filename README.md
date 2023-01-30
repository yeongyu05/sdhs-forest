# 🎋 디지텍 대나무 숲 (초기 모델)

## 페이지 설명 
- 회원가입 페이지
- 로그인 페이지 
- 메인 페이지 : 모든 사용자가 작성한 게시글이 최신 순으로 보인다
- 프로필 페이지 
- 게시글 페이지
    - 게시글 생성 페이지
    - 게시글 상세 페이지 ( 수정, 삭제 )
    - 게시글 통계 페이지

### 회원가입 페이지 설명 

- #### Form
    - `아이디`
    - `비밀번호`
    - `이름`
    - `프로필 사진` : 선택 사항


### 로그인 페이지 

- #### Form 
    - `아이디`
    - `비밀번호`


### 메인 페이지 (게시글)

- #### Descripition
    - `유저 프로필 사진`
    - `유저 이름`
    - `좋아요 버튼`
    - `좋아요 총 갯수`
    - `댓글 총 갯수`
    - `게시글 제목`
    - `게시글 내용`
    - `게시글 사진`


### 프로필 페이지 

- #### Descripition
    - 프로필 
        - `프로필 이미지`
        - `유저 아이디` : (#,@) ID
        - `유저 이름`
    - 본인의 프로필 페이지 일 떄 **게시글 생성 버튼** 존재
    - TABS 
        - TAB : 작성한 글 보기
        - TAB : 좋아요한 글 보기
    - 게시글은 메인페이지의 게시글과 설정 동일


### 게시글 생성 페이지 

- #### Form 
    - `게시글 제목`
    - `게시글 내용`
    - `게시글 이미지 등록` : 선택 사항

### 게시글 상세 페이지

- #### Descripition
    - 게시글
        - `게시글 제목`
        - `게시글 내용`
        - `게시글 이미지`
    - 본인 게시글 일 때 수정, 삭제 버튼이 보여야 된다.
    - 본인 게시글 일 때 통계 페이지 버튼이 보여야 된다.
    - 대댓글 기능 ( 댓글에 댓글까지만 )


### 게시글 통계 페이지

- #### Descripition
    - `게시글 전체 방문자 수`
    - `일일 방문자 수`
    - `주간 방문자 수 막대 그래프`


## 어드민 

### Setting
- `ADMIN ID` : ADMIN
- `ADMIN PW` : 1234
- `ADMIN NAME` : ADMIN


### 유저 통계 리스트

- #### Descripition
    - `유저 아이디`
    - `유저 이름`
    - `유저 프로필 사진`
    - `총 게시글 수`
    - `총 게시글 좋아요 수`
    - `총 게시글 댓글 수`