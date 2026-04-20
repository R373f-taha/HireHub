 
 
 ##             --------------------------    WELCOME  TO  MY  HIREHUB  ----------------------------


'phone' => 'required|phone:INTERNATIONAL'

'offer has many profiles through freelancer

one to one freelancer ,profile
one to many freelancer,offer

العلاقة بين الفريلانسر و العروض هيك صح
بحيث انو تكون ون تو ميني يعني الفريلانسر بيتفدم بعدة عروض و العرض الواحد من فريلانسر واحد
او لازم تكون ميني تو ميني


API Collection

https://documenter.getpostman.com/view/50321677/2sBXqDtPXQ

================================================================================
                              HIREHUB DATABASE SCHEMA
================================================================================

┌─────────────────────────────────────────────────────────────────────────────┐
│ 1. COUNTRIES                                                                 │
├─────────────────────────────────────────────────────────────────────────────┤
│ • id (PK)          - bigint        🔑                                       │
│ • name             - string        🌍                                       │
│ • created_at       - timestamp     📅                                       │
│ • updated_at       - timestamp     📅                                       │
└─────────────────────────────────────────────────────────────────────────────┘
                                      │ 1
                                      │ has
                                      │ o{
                                      ▼
┌─────────────────────────────────────────────────────────────────────────────┐
│ 2. CITIES                                                                   │
├─────────────────────────────────────────────────────────────────────────────┤
│ • id (PK)          - bigint        🔑                                       │
│ • name             - string        🏙️                                       │
│ • country_id (FK)  - bigint        → COUNTRIES.id                           │
│ • created_at       - timestamp     📅                                       │
│ • updated_at       - timestamp     📅                                       │
└─────────────────────────────────────────────────────────────────────────────┘
                                      │ 1
                                      │ located_in  (one to many)
                                      │ o{
                                      ▼
┌─────────────────────────────────────────────────────────────────────────────┐
│ 3. USERS                                                                    │
├─────────────────────────────────────────────────────────────────────────────┤
│ • id (PK)              - bigint        🔑                                   │
│ • name                 - string        👤                                   │
│ • email (UK)           - string        📧                                   │
│ • email_verified_at    - timestamp     ✅                                   │
│ • password             - string        🔒                                   │
│ • city_id (FK)         - bigint        → CITIES.id                           │
│ • role                 - enum          🎭 (client/freelancer/admin)         │
│ • remember_token       - string        🍪                                   │
│ • created_at           - timestamp     📅                                   │
│ • updated_at           - timestamp     📅                                   │
└─────────────────────────────────────────────────────────────────────────────┘
          │ 1                              │ 1
          │ is_a  (one to one)             │ is_a (one to one)
          ▼                                ▼
┌────────────────────────────┐  ┌────────────────────────────────────────────┐
│ 4.       (clients)         │  │ 5. FREELANCERS                             │
├────────────────────────────┤  ├────────────────────────────────────────────┤
│ • id (PK)         - bigint │  │ • id (PK)           - bigint               │
│ • user_id (FK)    - bigint │  │ • user_id (FK)      - bigint               │
│ • location_info   - json   │  │ • is_verified       - boolean              │
│ • created_at      - ts     │  │ • location_info     - json                 │
│ • updated_at      - ts     │  │ • is_active         - boolean              │
└────────────────────────────┘  │ • created_at        - timestamp            │
          │ 1                   │ • updated_at        - timestamp            │
          │ posts (one to many) └────────────────────────────────────────────┘  
          │ o{                                   │ 1
          ▼                                      │ has   
┌────────────────────────────────────────────────┼────────────────────────────┐
│ 6. PROJECTS                                    │ o{                         │
├────────────────────────────────────────────────┼────────────────────────────┤
│ • id (PK)              - bigint        🔑     │                            │
│ • title                - string        📌     │                            │
│ • description          - text          📄     │                            │
│ • type_of_balance      - enum          ⚖️     │                            │
│ • project_status       - enum          📊     │                            │
│ • budget               - json          💵     │                            │
│ • deadline             - date          ⏰     │                            │
│ • client_id (FK)       - bigint                                 │
│ • created_at           - timestamp     📅                                   │
│ • updated_at           - timestamp     📅                                   │
└─────────────────────────────────────────────────────────────────────────────┘
          │ 1                              │ 1                              │ 1
          │ receives                       │ has_review                     │ has
          │ o{                             │ ||                             │ o{
          ▼   one to many                  ▼  one to one                    ▼
┌────────────────────────────┐  ┌────────────────────────────┐  ┌────────────────────────────┐
│ 7. OFFERS                  │  │ 8. REVIEWS                 │  │ 9. ATTACHMENTS             │
├────────────────────────────┤  ├────────────────────────────┤  ├────────────────────────────┤
│ • id (PK)           bigint │  │ • id (PK)           bigint │  │ • id (PK)           bigint │
│ • project_id (FK)   bigint │  │ • project_id (FK)   bigint │  │ • file_name         string │
│ • freelancer_id(FK) bigint │  │ • freelancer_id(FK) bigint │  │ • file_path         string │
│ • proposed_amount   dec    │  │ • client_id (FK)    bigint │  │ • attachable_id     bigint │
│ • submission_letter text   │  │ • comment           text   │  │ • attachable_type   string │
│ • delivered_days    sint   │  │ • freelancer_rating int   │   │ • created_at        ts     │
│ • offer_status      enum   │  │ • project_rating    int   │   │ • updated_at        ts     │
│ • created_at        ts     │  │ • created_at        ts    │   └────────────────────────────┘
│ • updated_at        ts     │  │ • updated_at        ts    │
└────────────────────────────┘  └────────────────────────────┘

┌─────────────────────────────────────────────────────────────────────────────┐
│ 10. SKILLS                                                                   │
├─────────────────────────────────────────────────────────────────────────────┤
│ • id (PK)          - bigint        🔑                                       │
│ • skill_name       - string        🎯                                       │
│ • created_at       - timestamp     📅                                       │
│ • updated_at       - timestamp     📅                                       │
└─────────────────────────────────────────────────────────────────────────────┘
                                      │ 1
                                      │ used_in     many to many (skills & freelancers)
                                      │ o{
                                      ▼
┌─────────────────────────────────────────────────────────────────────────────┐
│ 11. FREELANCER_SKILL (Pivot)                                                 │
├─────────────────────────────────────────────────────────────────────────────┤
│ • id (PK)              - bigint        🔑                                   │
│ • years_of_experience  - int           ⏱️                                   │
│ • freelancer_id (FK)   - bigint        → FREELANCERS.id                     │
│ • skill_id (FK)        - bigint        → SKILLS.id                          │
└─────────────────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────────────────┐
│ 12. TAGS                                                                     │
├─────────────────────────────────────────────────────────────────────────────┤
│ • id (PK)          - bigint        🔑                                       │
│ • name             - string        🏷️                                       │
│ • created_at       - timestamp     📅                                       │
│ • updated_at       - timestamp     📅                                       │
└─────────────────────────────────────────────────────────────────────────────┘
                                      │ 1
                                      │ assigned_to    many to many (tags & projects)
                                      │ o{
                                      ▼
┌─────────────────────────────────────────────────────────────────────────────┐
│ 13. PROJECT_TAG (Pivot)                                                      │
├─────────────────────────────────────────────────────────────────────────────┤
│ • id (PK)          - bigint        🔑                                       │
│ • tag_id (FK)      - bigint        → TAGS.id                                │
│ • project_id (FK)  - bigint        → PROJECTS.id                            │
└─────────────────────────────────────────────────────────────────────────────┘


                     and every verified freelancer has only one profile (one to one)

┌─────────────────────────────────────────────────────────────────────────────┐
│ 14. PROFILES                                                                 │
├─────────────────────────────────────────────────────────────────────────────┤
│ • id (PK)              - bigint        🔑                                   │
│ • bio                  - text          📝                                   │
│ • first_name           - string        👨                                   │
│ • last_name            - string        👨                                   │
│ • image                - string        🖼️                                   │
│ • protofilo_link       - string        🔗                                   │
│ • hour_rate            - decimal       💰                                   │
│ • phone                - string        📞                                   │
│ • skills_summery       - json          📊                                   │
│ • available_mode       - enum          ⚡ (available/not available/busy)    │
│ • freelancer_id (FK)   - bigint        → FREELANCERS.id                     │
│ • created_at           - timestamp     📅                                   │
│ • updated_at           - timestamp     📅                                   │
└─────────────────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────────────────┐
│ 15. PERSONAL_ACCESS_TOKENS (Sanctum)                                         │
├─────────────────────────────────────────────────────────────────────────────┤
│ • id (PK)          - bigint        🔑                                       │
│ • tokenable_id     - bigint        👤 → USERS.id                            │
│ • tokenable_type   - string        📂                                       │
│ • name             - text          🏷️                                       │
│ • token (UK)       - string        🎫                                       │
│ • abilities        - text          🔧                                       │
│ • last_used_at     - timestamp     🕐                                       │
│ • expires_at       - timestamp     ⏳                                       │
│ • created_at       - timestamp     📅                                       │
│ • updated_at       - timestamp     📅                                       │
└─────────────────────────────────────────────────────────────────────────────┘

================================================================================
                              RELATIONSHIPS SUMMARY
================================================================================

COUNTRIES 1───∞ CITIES
CITIES    1───∞ USERS
CLIENTS   1───∞ PROJECTS
USERS     1───1 LIMBS (client)
USERS     1───1 FREELANCERS
FREELANCERS 1───1 PROFILES
FREELANCERS 1───∞ FREELANCER_SKILL
SKILLS    1───∞ FREELANCER_SKILL
PROJECTS  1───∞ PROJECT_TAG
TAGS      1───∞ PROJECT_TAG
PROJECTS  1───∞ OFFERS
CLIENTS    1───∞ REVIEWS
FREELANCERS 1───∞ OFFERS
PROJECTS  1───1 REVIEWS
FREELANCERS 1───∞ REVIEWS
PROJECTS  1───∞ ATTACHMENTS (polymorphic)
FREELANCERS 1───∞ ATTACHMENTS (polymorphic)
OFFERS    1───∞ ATTACHMENTS (polymorphic)
PROFILES  1───∞ ATTACHMENTS (polymorphic)
USERS     1───∞ PERSONAL_ACCESS_TOKENS
COUNTRY HAS MANY USERS THROUGH CITY
================================================================================
